<?php

namespace App\Http\Services\API\tenant\Driver\Order;

use App\Models\Tenant\Order;
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

        $query = Order::with('payment_method')
            ->delivery()
            ->when($request->status == 'ready', function ($query) {
                $settings = Setting::first();
                $limitDrivers = $settings->limit_delivery_company ?? config('application.limit_delivery_company', 15);

                return $query
                    ->where('deliver_by', null)
                    ->where('driver_id', null)
                    ->readyForDriver()
                    ->when($settings && $settings->delivery_companies_option && $limitDrivers > 0, function ($query) use ($limitDrivers) {
                        return $query->where('received_by_restaurant_at', '>', now()->subMinutes($limitDrivers));
                    });
            })
            ->when($request->status == 'all' || !$request->status, function ($query) use ($user) {
                return $query
                    ->where('deliver_by', null)
                    ->where(function ($query) use ($user) {
                        $query->where('driver_id', $user->id)
                            ->orWhereNull('driver_id');
                    });
            })
            ->when($request->status == 'accepted' || $request->status == 'cancelled' || $request->status == 'completed', function ($query) use ($request) {
                return $query->whenStatus($request->status);
            })
            ->recent();

        $perPage = config('application.perPage', 20);
        $orders = $query->paginate($perPage);

        return $this->sendResponse(new OrderCollection($orders), '');
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
        if($request->status == Order::COMPLETED){
            $order->status = Order::COMPLETED;
            $order->save();
            $this->sendNotifications($order);
            return $this->sendResponse('', __('Order has been completed successfully'));
        }elseif($request->status == Order::CANCELLED){
            $order->status = Order::CANCELLED;
            $order->reject_or_cancel_reason = $request->reason;
            $order->save();
            return $this->sendResponse('', __('Order has been cancelled successfully'));
        }elseif($request->status == Order::ACCEPTED){//Mean picked up
            $order->status = $request->status;
            $order->driver_id = $user->id;
            $order->save();
            return $this->sendResponse('', __('Order has been picked up successfully'));
        }
        return $this->sendError('', __('You can not change this order status'));
    }
    public function assignOrder(Request $request, Order $order)
    {
        /** @var RestaurantUser $user */
        $user = Auth::user();
        if(
            ($order->status == Order::RECEIVED_BY_RESTAURANT || $order->status == Order::READY)
            && ($order->driver_id == null || $order->driver_id == $user->id)
            && $order->deliver_by == null
        ){
            $order->driver_id = $user->id;
            $order->save();
            return $this->sendResponse('', __('Order has been assigned to you successfully'));
        }
        return $this->sendError('', __('You can not assign this order for you'));
    }
    public function sendNotifications($order)
    {
        //Internal notification
        $type = NotificationTypeEnum::OrderDelivered;
        $message = __('Order has been delivered for customer (:name).',['name' => $order?->user?->full_name]);
        //Send notification to all worker
        $workers = RestaurantUser::workers()
        ->where('branch_id',$order->branch_id)
        ->get();
        if($workers->count())
            Notification::send($workers, new NotificationAction($type, $message, $order->toArray()));
    }
}
