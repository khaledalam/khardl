<?php

namespace App\Http\Controllers\API\Tenant;

use App\Models\Tenant\Order;
use Illuminate\Http\Request;
use App\Utils\ResponseHelper;
use App\Models\Tenant\Setting;
use Faker\Provider\id_ID\Color;
use Illuminate\Validation\Rule;
use App\Traits\APIResponseTrait;
use App\Jobs\AssignDeliveryCompany;

use App\Models\Tenant\PaymentMethod;
use Illuminate\Support\Facades\Auth;
use App\Models\Tenant\OrderStatusLogs;
use App\Repositories\API\OrderRepository;
use App\Packages\TapPayment\Refund\Refund;
use App\Http\Requests\OrderStatusChangeRequest;
use App\Packages\DeliveryCompanies\Cervo\Cervo;
use App\Packages\DeliveryCompanies\Yeswa\Yeswa;
use Illuminate\Contracts\Database\Query\Builder;
use App\Repositories\API\CustomerOrderRepository;
use App\Packages\DeliveryCompanies\DeliveryCompanies;
use App\Packages\DeliveryCompanies\StreetLine\StreetLine;
use App\Packages\DeliveryCompanies\AbstractDeliveryCompany;
use App\Http\Controllers\API\Tenant\BaseRepositoryController;

class  OrderController extends BaseRepositoryController
{
    use APIResponseTrait;
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if(request()->bearerToken()){ // coming from  app api
                $this->default_repository = new OrderRepository();
            }else {
                $this->default_repository = new CustomerOrderRepository();
            }
            return $next($request);

        });
    }

    public function logs($order, Request $request){

        $orderStatusLogs = OrderStatusLogs::all()->where('order_id', '=', $order)->sortByDesc("created_at");

        return $this->sendResponse($orderStatusLogs, __('Order status logs fetched'));
    }

    public function updateStatus($order,OrderStatusChangeRequest $request){

        $user = Auth::user();
        $order = Order::
        when($user->isWorker(), function (Builder $query, string $role)use($user) {
            $query ->where('branch_id',$user->branch->id);
        })
        ->findOrFail($order);

        if($order->isDelivery()&&($request->status == Order::COMPLETED || $request->status == Order::CANCELLED)){
            return $this->sendError('', __('Only drivers can change this order with this status'));
        }
        if ($request->status == Order::RECEIVED_BY_RESTAURANT && $order->isDelivery() && !$order?->branch?->delivery_availability) {
            if ($request->expectsJson()) {
                return $this->sendError('Fail', __('This branch does not support delivery'));
            }
            return redirect()->back()->with('error',__('This branch does not support delivery'));
        }
        $setting = Setting::first();
        $statusLog = new OrderStatusLogs();
        $statusLog->order_id = $order->id;
        $statusLog->status = $request->status;
        if(
            ($request->status == Order::REJECTED || $request->status == Order::CANCELLED) 
            && $order->payment_method->name == PaymentMethod::ONLINE 
            && $order->payment_status == PaymentMethod::PAID 
            && $order->transaction_id
            && $setting->merchant_id
        ){
    
            
            $refund = Refund::create([
                "charge_id"=> $order->transaction_id,
                "amount"=> $order->total,
                "reason"=>($request->reason)?$request->reason:"The order has been $request->status"
            ],
            $setting->merchant_id
            );
            if ($refund['http_code'] == ResponseHelper::HTTP_OK && $refund['message']['status'] == 'REFUNDED') {
                $order->status = $request->status;
                $order->payment_status = PaymentMethod::REFUNDED;
                if($order->reason) $order->reject_or_cancel_reason = $request->reason;
                $order->save();

                if ($request->expectsJson()) {
                    return $this->sendResponse(null, __('Order has been updated successfully with Refunded'));
                }
                return redirect()->back()->with('success',__('Order has been updated successfully with Refunded'));

            }else {
                if ($request->expectsJson()) {
                    return $this->sendError('Fail', __('The process of refunding the amount to the customer failed'));
                }
                return redirect()->back()->with('error',__('The process of refunding the amount to the customer failed'));
            }
        }
        if($request->status == Order::REJECTED && $request->reason){

            $order->update([
                'status' => $request->status,
                'reject_or_cancel_reason' => $request->reason
            ]);
            if($order->isDelivery()){
                (new Cervo)->cancelOtherOrders('All',$order);
            }
        }
        switch ($request->status) {
            case Order::PENDING:
                $statusLog->class_name = 'text-warning';
                break;
            case Order::RECEIVED_BY_RESTAURANT:
                $statusLog->class_name = 'text-secondary';
                break;
            case Order::ACCEPTED:
                $statusLog->class_name = 'text-success';
                break;
            case Order::READY:
                $statusLog->class_name = 'text-info';
                break;
            case Order::CANCELLED || Order::REJECTED:
                $statusLog->class_name = 'text-danger';
                break;
            case Order::COMPLETED:
                if($order->payment_method->name ==  PaymentMethod::CASH_ON_DELIVERY){
                    $order->update([
                        'payment_status'=> PaymentMethod::PAID
                    ]);
                }
                $statusLog->class_name = 'text-primary';
                break;
        }
        $statusLog->notes = $request->notes ?? null;
        $statusLog->saveOrFail();

        // Handle register order to all delivery companies

        if ($request->status == Order::RECEIVED_BY_RESTAURANT && $order->isDelivery() && $order?->branch?->delivery_availability) {
            return $this->handelDeliveryOrder($order,$request);
        }
        $order->update(['status' => $request->status]);
        if ($request->expectsJson()) {
            return $this->sendResponse(null, __('Order has been updated successfully.'));
        }

        return redirect()->back()->with('success',__('Order has been updated successfully.'));
    }
    public function getStatus($status){
        $statues = Order::ChangeStatus($status);
        return response()->json(array_combine($statues,array_map(fn ($status) => __(''.$status),$statues)),200);
    }

    public function handelDeliveryOrder($order,$request)
    {
        $settings = Setting::first();
        if($settings && $settings->drivers_option && $settings->delivery_companies_option){
            if($settings->limit_delivery_company){
                AssignDeliveryCompany::dispatch($request->expectsJson(),$order,$request->status)->delay(now()->addMinutes($settings->limit_delivery_company));
            }else{
                AssignDeliveryCompany::dispatch($request->expectsJson(),$order,$request->status)->delay(now()->addMinutes(config('application.limit_delivery_company') ?? 15));
            }
            $order->update(['status' => $request->status]);
            if ($request->expectsJson()) {
                return $this->sendResponse(null, __('Order has been updated successfully.'));
            }
            return redirect()->back()->with('success',__('Order has been updated successfully.'));
        }elseif($settings && $settings->delivery_companies_option){
            $order->update(['status' => $request->status]);
            return $this->assignOrderToDC($request->expectsJson(),$order,$request->status);
        }else {
            if ($request->expectsJson()) {
                return $this->sendError('Fail', __('Restaurant does not have any delivery companies yet'));
            }
            return redirect()->back()->with('error',__('Restaurant does not have any delivery companies yet'));
        }
    }
    public function assignOrderToDC($exceptJson,$order,$status)
    {
        $deliveryCompanies = DeliveryCompanies::assign($order,$order->user);
        if(empty($deliveryCompanies)){
            if ($exceptJson) {
                return $this->sendError('Fail', __('There is no available delivery company'));
            }
            return redirect()->back()->with('error',__('There is no available delivery company'));
        }else {
            $deliveryCompaniesDelivered = implode(" , ", $deliveryCompanies);
            $order->update(['status' => $status,'received_by_restaurant_at'=> now()]);

            if ($exceptJson) {
                return $this->sendResponse(null, __("Order has been delivered to :companies, waiting for accepting ...",["companies"=>$deliveryCompaniesDelivered]));
            }
            return redirect()->back()->with('success', __("Order has been delivered to :companies, waiting for accepting ...",["companies"=>$deliveryCompaniesDelivered]));
        }
    }


}
