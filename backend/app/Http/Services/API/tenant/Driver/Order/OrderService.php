<?php

namespace App\Http\Services\API\tenant\Driver\Order;

use App\Http\Resources\API\Tenant\Collection\Driver\DriverOrderCollection;
use App\Http\Resources\API\Tenant\OrderResource;
use App\Models\Tenant\Order;
use App\Models\Tenant\PaymentMethod;
use Illuminate\Http\Request;
use App\Models\Tenant\Setting;
use App\Traits\APIResponseTrait;
use Illuminate\Support\Facades\Auth;
use App\Models\Tenant\RestaurantUser;
use App\Enums\Admin\NotificationTypeEnum;
use App\Notifications\NotificationAction;
use Illuminate\Support\Facades\Notification;
use App\Http\Requests\API\Driver\Order\ChangeStatusRequest;
use App\Http\Resources\API\Tenant\Collection\Driver\OrderCollection;

class OrderService
{
    use APIResponseTrait;
    public function getList(Request $request)
    {
        /** @var RestaurantUser $user */
        $user = Auth::user();

        $query = Order::with(['payment_method', 'items', 'branch', 'user'])
            ->driverOrders()
            ->WhenDateRange($request['from'] ?? null, $request['to'] ?? null)
            ->WhenDateString($request['date_string'] ?? null)
            ->when($request->status == 'ready', function ($query) {
                return $query
                    ->where('deliver_by', null)
                    ->where('driver_id', null)
                    ->readyForDriver()
                    ->where(function ($query) {
                        $query->shouldLimitDrivers()->shouldAssignDriver();
                    });
            })
            ->when($request->status == 'all' || !$request->status, function ($query) use ($user) {
                return $query
                    ->where('deliver_by', null)
                    ->where('status','!=', Order::CANCELLED)
                    ->where('status','!=', Order::COMPLETED)
                    ->where(function ($query) use ($user) {
                        $query->where('driver_id', $user->id)
                        ->orWhere(function ($query) {
                            $query->shouldLimitDrivers()->shouldAssignDriver();
                        });
                    });
            })
            ->when($request->status!='ready' && $request->status !='all', function ($query) use ($request, $user) {
                return $query->where('driver_id', $user->id)
                ->whenDriverStatus($request->status);
            })
            ->recentUpdated();

        $perPage = $request['perPage'] ?? config('application.perPage', 20);
        $orders = $query->paginate($perPage);
        return $this->sendResponse(new OrderCollection($orders), '');
    }
    public function history(Request $request)
    {
        /** @var RestaurantUser $user */
        $user = Auth::user();
        $query = $user->driver_orders()
            ->with(['user'])
            ->WhenDateRange($request['from'] ?? null, $request['to'] ?? null)
            ->whenDriverStatus($request['status'] ?? null)
            ->WhenDateString($request['date_string'] ?? null)
            ->recent();

        $perPage = $request['perPage'] ?? config('application.perPage', 20);
        $orders = $query->paginate($perPage);

        return $this->sendResponse(new DriverOrderCollection($orders), '');
    }
    public function orderDetails(Request $request, Order $order)
    {
        $order->load(['user', 'branch', 'items']);
        return $this->sendResponse(new OrderResource($order), '');
    }
    /*
    "accepted" when receive from restaurant (prerequisite "received_by_restaurant")
    "completed" when the order is delivered (prerequisite "accepted")
    "cancelled" when the order is cancelled from customer or issue exist (prerequisite "accepted")
    */
    public function changeStatus(ChangeStatusRequest $request, Order $order)
    {
        /** @var RestaurantUser $user */
        $user = Auth::user();
        if ($request->status == Order::COMPLETED) {
            $order->status = Order::COMPLETED;
            if($order->isCashOnDelivery()){
                $order->payment_status = PaymentMethod::PAID;
            }
            $order->save();
            $this->sendNotifications($user, $order);
            return $this->sendResponse('', __('Order has been completed successfully'));
        } /* elseif ($request->status == Order::CANCELLED) {
            $order->status = Order::CANCELLED;
            $order->reject_or_cancel_reason = $request->reason;
            $order->save();
            return $this->sendResponse('', __('Order has been cancelled successfully'));
        }  */elseif ($request->status == Order::ACCEPTED) {//Mean picked up
            $order->status = $request->status;
            $order->driver_id = $user->id;
            $order->accepted_at = now();
            $order->save();
            return $this->sendResponse('', __('Order has been picked up successfully'));
        }
        return $this->sendError('', __('You can not change this order status'));
    }
    public function assignOrder(Request $request, Order $order)
    {
        /** @var RestaurantUser $user */
        $user = Auth::user();
        if(!$order->branch?->drivers_option){
            return $this->sendError('',__('You can not pickup order because branch disable own drivers to pickup orders.'));
        }
        if (
            ($order->status == Order::RECEIVED_BY_RESTAURANT || $order->status == Order::READY)
            && ($order->driver_id == null || $order->driver_id == $user->id)
            && ($order->branch_id == $user->branch_id)
            && $order->deliver_by == null
        ) {
            $order->driver_id = $user->id;
            $order->save();
            return $this->sendResponse('', __('Order has been assigned to you successfully'));
        }
        return $this->sendError('', __('You can not assign this order for you'));
    }
    public function sendNotifications($user, $order)
    {

        //Internal notification
        $type = NotificationTypeEnum::OrderDelivered;
        $message = [
            'en' => 'Order has been delivered for customer (' . $user->full_name . ').',
            'ar' => 'تم توصيل الطلب للعميل (' . $user->full_name . ').'
        ];
        $title = [
            'ar' => 'الطلب وصل',
            'en' => 'Order delivered'
        ];
        //Send notification to all worker
        $workers = RestaurantUser::workers()
            ->where('branch_id', $order->branch_id)
            ->get();
        if ($workers->count()) {
            Notification::send($workers, new NotificationAction($type, $message, $order->toArray()));
            $data = $order->only(['id', 'user_id', 'branch_id', 'delivery_type_id', 'total']);
            $this->handleSingleNotification($workers, $data, $title, $message, $type->value);
        }
    }
    public function handleSingleNotification($workers, $data, $title, $body, $type)
    {
        foreach ($workers as $worker) {
            $lang = $worker->default_lang == 'ar' ? 'ar' : 'en';
            $notifyTitle = $title[$lang];
            $notifyBody = $body[$lang];
            sendPushNotification($worker, $data, $notifyTitle, $notifyBody, $type, 'internal');
        }
    }
}
