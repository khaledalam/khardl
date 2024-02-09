<?php

namespace App\Http\Services\API\tenant\Driver\Order;

use App\Models\Tenant\Order;
use App\Models\Tenant\Setting;
use App\Traits\APIResponseTrait;
use Illuminate\Support\Facades\Auth;
use App\Models\Tenant\RestaurantUser;
use App\Http\Resources\API\Tenant\Collection\Driver\OrderCollection;
use Illuminate\Http\Request;

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
                    ->receivedByRestaurant()
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
    public function changeStatus(Request $request, Order $order)
    {
        /** @var RestaurantUser $user */
        $user = Auth::user();
        if ($order->status == Order::ACCEPTED && $order->driver_id == $user->id) {
            if($request->status == Order::COMPLETED){
                $order->status = Order::COMPLETED;
                $order->save();
                return $this->sendResponse('', __('Order has been completed successfully'));
            }elseif($request->status == Order::CANCELLED){
                $order->status = Order::CANCELLED;
                $order->save();
                return $this->sendResponse('', __('Order has been cancelled successfully'));
            }
        }else if ($order->status == Order::RECEIVED_BY_RESTAURANT && $order->driver_id == null && $order->deliver_by == null) {
            $settings = Setting::first();
            $limitDrivers = $settings->limit_delivery_company;
            if ($limitDrivers && $limitDrivers > 0) {
                if (!($order->received_by_restaurant_at > now()->subMinutes($limitDrivers))) {
                    return $this->sendError('', __('You cannot pick up this order now because you have exceeded the time allowed for order pickup'));
                }
            }
            $order->status = Order::ACCEPTED;
            $order->driver_id = $user->id;
            $order->save();
            return $this->sendResponse('', __('Order has been received successfully'));
        }
        return $this->sendError('', __('You can not change this order status'));
    }
}
