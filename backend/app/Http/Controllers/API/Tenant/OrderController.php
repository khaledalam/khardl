<?php

namespace App\Http\Controllers\API\Tenant;

use App\Enums\Admin\NotificationTypeEnum;
use App\Models\Tenant\Order;
use App\Models\Tenant\RestaurantUser;
use App\Notifications\NotificationAction;
use Illuminate\Http\Request;
use App\Utils\ResponseHelper;
use App\Models\Tenant\Setting;
use App\Traits\APIResponseTrait;
use App\Jobs\AssignDeliveryCompany;
use Illuminate\Support\Facades\Notification;
use App\Models\Tenant\PaymentMethod;
use Illuminate\Support\Facades\Auth;
use App\Models\Tenant\OrderStatusLogs;
use App\Repositories\API\OrderRepository;
use App\Packages\TapPayment\Refund\Refund;
use App\Http\Requests\OrderStatusChangeRequest;
use App\Packages\DeliveryCompanies\Cervo\Cervo;
use Illuminate\Contracts\Database\Query\Builder;
use App\Repositories\API\CustomerOrderRepository;
use App\Packages\DeliveryCompanies\DeliveryCompanies;
use App\Http\Controllers\API\Tenant\BaseRepositoryController;
use Exception;
use Spatie\WebhookClient\Models\WebhookCall;

class OrderController extends BaseRepositoryController
{
    use APIResponseTrait;
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (request()->bearerToken()) { // coming from  app api
                $this->default_repository = new OrderRepository();
            } else {
                $this->default_repository = new CustomerOrderRepository();
            }
            return $next($request);

        });
    }

    public function logs($order, Request $request)
    {

        $orderStatusLogs = OrderStatusLogs::all()->where('order_id', '=', $order)->sortByDesc("created_at");

        return $this->sendResponse($orderStatusLogs, __('Order status logs fetched'));
    }

    public function updateStatus($order, OrderStatusChangeRequest $request)
    {
        $user = Auth::user();
        $order = Order::
            when($user->isWorker(), function (Builder $query, string $role) use ($user) {
                $query->where('branch_id', $user->branch->id);
            })
            ->findOrFail($order);

        if ($order->isDelivery() && ($request->status == Order::COMPLETED || $request->status == Order::CANCELLED)) {
            return $this->sendError('', __('Only drivers can change this order with this status'));
        }
        if ($request->status == Order::RECEIVED_BY_RESTAURANT && $order->isDelivery() && !$order?->branch?->delivery_availability) {
            if ($request->expectsJson()) {
                return $this->sendError('Fail', __('This branch does not support delivery'));
            }
            return redirect()->back()->with('error', __('This branch does not support delivery'));
        }
        $setting = Setting::first();
        $statusLog = new OrderStatusLogs();
        $statusLog->order_id = $order->id;
        $statusLog->status = $request->status;
        if (
            ($request->status == Order::REJECTED || $request->status == Order::CANCELLED)
            && $order->payment_method->name == PaymentMethod::ONLINE
            && $order->payment_status == PaymentMethod::PAID
            && $order->transaction_id
            && $setting->merchant_id
        ) {


            $refund = Refund::create(
                [
                    "charge_id" => $order->transaction_id,
                    "amount" => $order->total,
                    "reason" => ($request->reason) ? $request->reason : "The order has been $request->status"
                ]
            );
            if ($refund['http_code'] == ResponseHelper::HTTP_OK && $refund['message']['status'] == 'REFUNDED') {
                $order->status = $request->status;
                $order->payment_status = PaymentMethod::REFUNDED;
                $order->refund_id = $refund['message']['id'];
                if ($order->reason)
                    $order->reject_or_cancel_reason = $request->reason;
                $order->save();
                WebhookCall::create([
                    'name' => 'tap-payment',
                    'url' => route('webhook-client-tap-payment'),
                    'payload' => $refund['message']
                ]);
                if ($request->expectsJson()) {
                    return $this->sendResponse(null, __('Order has been updated successfully with Refunded'));
                }
                return redirect()->back()->with('success', __('Order has been updated successfully with Refunded'));

            } else {
                WebhookCall::create([
                    'name' => 'tap-payment',
                    'url' => route('webhook-client-tap-payment'),
                    'payload' => $refund['message'],
                    'exception' => $refund['message']
                ]);
                if ($request->expectsJson()) {
                    return $this->sendError('Fail', __('The process of refunding the amount to the customer failed'));
                }
                return redirect()->back()->with('error', __('The process of refunding the amount to the customer failed'));
            }
        }
        if ($request->status == Order::REJECTED && $request->reason) {

            $order->update([
                'status' => $request->status,
                'reject_or_cancel_reason' => $request->reason
            ]);
            if ($order->isDelivery()) {
                (new Cervo)->cancelOtherOrders('All', $order);
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
                if ($order->payment_method->name == PaymentMethod::CASH_ON_DELIVERY) {
                    $order->update([
                        'payment_status' => PaymentMethod::PAID
                    ]);
                }
                $statusLog->class_name = 'text-primary';
                break;
        }
        $statusLog->notes = $request->notes ?? null;
        $statusLog->saveOrFail();

        // Handle register order to all delivery companies

        if ($request->status == Order::RECEIVED_BY_RESTAURANT && $order->isDelivery() && $order?->branch?->delivery_availability) {
            return $this->handelDeliveryOrderWhenReceived($order, $request);
        }
        if ($request->status == Order::READY && $order->isDelivery() && $order?->branch?->delivery_availability) {
            $this->handelDeliveryOrderWhenReady($order);
        }
        $order->update(['status' => $request->status]);
        if ($request->expectsJson()) {
            return $this->sendResponse(null, __('Order has been updated successfully.'));
        }

        return redirect()->back()->with('success', __('Order has been updated successfully.'));
    }
    public function getStatus($status)
    {
        $statues = Order::ChangeStatus($status);
        return response()->json(array_combine($statues, array_map(fn($status) => __('' . $status), $statues)), 200);
    }
    public function handelDeliveryOrderWhenReady($order)
    {
        $settings = Setting::first();
        //Check that deliver companies not assign driver and drivers options is enabled
        if ($order->deliver_by == null && $settings && $settings->drivers_option) {
            if ($order->driver_id == null) {//Check that no driver assigned to this order yet
                $this->sendNotificationsWhenReady($order);
            } else {// there is driver assigned to this order
                $this->sendNotificationsWhenReady($order, $order->driver);
            }
        }
    }
    public function handelDeliveryOrderWhenReceived($order, $request)
    {
        $settings = Setting::first();
        if ($settings && $settings->drivers_option && $settings->delivery_companies_option) {
            if ($settings->limit_delivery_company) {
                AssignDeliveryCompany::dispatch($request->expectsJson(), $order, $request->status)->delay(now()->addMinutes($settings->limit_delivery_company));
            } else {
                AssignDeliveryCompany::dispatch($request->expectsJson(), $order, $request->status)->delay(now()->addMinutes(config('application.limit_delivery_company') ?? 15));
            }
            $order->update(['status' => $request->status,  'received_by_restaurant_at' => now()]);
            if ($request->expectsJson()) {
                return $this->sendResponse(null, __('Order has been updated successfully.'));
            }
            return redirect()->back()->with('success', __('Order has been updated successfully.'));
        } elseif ($settings && $settings->delivery_companies_option) {
            $order->update(['status' => $request->status]);
            return $this->assignOrderToDC($request->expectsJson(), $order, $request->status);
        } elseif ($settings && $settings->drivers_option) {
            $this->sendNotificationsWhenReceivedByRestaurant($order);
            $order->update(['status' => $request->status, 'received_by_restaurant_at' => now()]);
            if ($request->expectsJson()) {
                return $this->sendResponse(null, __('Order has been updated successfully.'));
            }
            return redirect()->back()->with('success', __('Order has been updated successfully.'));
        } else {
            if ($request->expectsJson()) {
                return $this->sendError('Fail', __('Restaurant does not have any delivery companies yet'));
            }
            return redirect()->back()->with('error', __('Restaurant does not have any delivery companies yet'));
        }
    }
    public function assignOrderToDC($exceptJson, $order, $status)
    {
        $deliveryCompanies = DeliveryCompanies::assign($order, $order->user);
        if (empty($deliveryCompanies)) {
            if ($exceptJson) {
                return $this->sendError('Fail', __('There is no available delivery company'));
            }
            return redirect()->back()->with('error', __('There is no available delivery company'));
        } else {
            $deliveryCompaniesDelivered = implode(" , ", $deliveryCompanies);
            $order->update(['status' => $status, 'received_by_restaurant_at' => now()]);

            if ($exceptJson) {
                return $this->sendResponse(null, __("Order has been delivered to :companies, waiting for accepting ...", ["companies" => $deliveryCompaniesDelivered]));
            }
            return redirect()->back()->with('success', __("Order has been delivered to :companies, waiting for accepting ...", ["companies" => $deliveryCompaniesDelivered]));
        }
    }
    public function sendNotificationsWhenReceivedByRestaurant($order)
    {
        $type = NotificationTypeEnum::NewOrderAvailable;
        $message = [
            'en' => 'You can assign order #' . $order->id . ' now.',
            'ar' => 'يمكنك الان تعيين طلب رقم' . $order->id . ' لك '
        ];
        $title = [
            'en' => 'New order available.',
            'ar' => 'طلب جديد متاح.'
        ];
        $this->sendToDrivers($order, $type, $title, $message);

    }
    public function sendNotificationsWhenReady($order, $driver = null)
    {
        $type = NotificationTypeEnum::OrderReady;
        $message = [
            'en' => 'Order #' . $order->id . ' is ready now for pickup.',
            'ar' => 'الطلب رقم # ' . $order->id . ' متاح الان للتوصيل'
        ];
        $title = [
            'en' => 'Order is ready.',
            'ar' => 'الطلب جاهز.'
        ];
        if ($driver) {
            $this->sendToSpecificDrivers($driver, $order, $type, $title, $message);
        } else {
            $this->sendToDrivers($order, $type, $title, $message);
        }

    }
    public function sendToSpecificDrivers($driver, $order, $type, $title, $message)
    {
        $data = $order->only(['id', 'user_id', 'branch_id', 'total','delivery_type','branch','accepted_at','payment_status']);
        Notification::send($driver, new NotificationAction($type, $message, $data));
        $this->handleSinglePushNotification($driver, $data, $title, $message, $type->value);
    }
    public function sendToDrivers($order, $type, $title, $message)
    {
        //Send notification to all drivers
        $drivers = RestaurantUser::drivers()
            ->where('branch_id', $order->branch_id)
            ->get();
        if ($drivers->count()) {
            $data = $order->only(['id', 'user_id', 'branch_id', 'total','delivery_type','branch','accepted_at','payment_status']);
            Notification::send($drivers, new NotificationAction($type, $message, $data));
            return $this->handleMultiPushNotification($drivers, $data, $title, $message, $type->value);
        }
    }
    public function handleMultiPushNotification($drivers, $data, $title, $body, $type)
    {
        foreach ($drivers as $driver) {
            $lang = $driver->default_lang == 'ar' ? 'ar' : 'en';
            $notifyTitle = $title[$lang];
            $notifyBody = $body[$lang];
            sendPushNotification($driver, $data, $notifyTitle, $notifyBody, $type);
        }
    }
    public function handleSinglePushNotification($driver, $data, $title, $body, $type)
    {
        $lang = $driver->default_lang == 'ar' ? 'ar' : 'en';
        $notifyTitle = $title[$lang];
        $notifyBody = $body[$lang];
        sendPushNotification($driver, $data, $notifyTitle, $notifyBody, $type);
    }


}
