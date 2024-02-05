<?php

namespace App\Http\Controllers\API\Tenant;

use App\Models\Tenant\Order;
use Illuminate\Http\Request;
use Faker\Provider\id_ID\Color;
use Illuminate\Validation\Rule;
use App\Traits\APIResponseTrait;
use App\Models\Tenant\PaymentMethod;

use Illuminate\Support\Facades\Auth;
use App\Models\Tenant\OrderStatusLogs;
use App\Repositories\API\OrderRepository;
use App\Http\Requests\OrderStatusChangeRequest;
use Illuminate\Contracts\Database\Query\Builder;
use App\Repositories\API\CustomerOrderRepository;
use App\Packages\DeliveryCompanies\DeliveryCompanies;
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
     
        $statusLog = new OrderStatusLogs();
        $statusLog->order_id = $order->id;
        $statusLog->status = $request->status;
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
            case Order::CANCELLED:
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
        if ($request->status == Order::RECEIVED_BY_RESTAURANT) {
            $deliveryCompanies = DeliveryCompanies::assign($order,$order->user);
            if(empty($deliveryCompanies)){
                if ($request->expectsJson()) {
                    return $this->sendError('Fail', __('There is no available delivery company'));
                }
                return redirect()->back()->with('error',__('There is no available delivery company'));
            }else {
                $deliveryCompaniesDelivered = implode(" , ", $deliveryCompanies);
                $order->update(['status' => $request->status]);
                if ($request->expectsJson()) {
                    return $this->sendResponse(null, __("Order has been delivered to :companies, waiting for accepting ...",["companies"=>$deliveryCompaniesDelivered]));
                }
                
              
                return redirect()->back()->with('success', __("Order has been delivered to :companies, waiting for accepting ...",["companies"=>$deliveryCompaniesDelivered]));
            }
        }
        $order->update(['status' => $request->status]);
        if ($request->expectsJson()) {
            return $this->sendResponse(null, __('Order has been updated successfully.'));
        }

        return redirect()->back()->with('success',__('Order has been updated successfully.'));
    }
    public function getStatus($status){
        $statues = Order::ChangeStatus($status);
        return response()->json(array_combine($statues,array_map(fn ($status) => __('messages.'.$status),$statues)),200);
    }
    

}
