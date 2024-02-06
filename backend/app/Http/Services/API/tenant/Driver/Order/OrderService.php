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
        $orders = Order::with('payment_method')
            ->where('driver_id', $user->id)
            ->whenStatus($request['status'] ?? null)
            ->delivery()
            ->recent()
            ->paginate(config('application.perPage') ?? 20);
        return $this->sendResponse(new OrderCollection($orders), '');
    }
    public function ready()
    {
        $settings = Setting::first();
        $limitDrivers = $settings->limit_delivery_company;
        $query = Order::with('payment_method')->delivery()
            ->where('deliver_by', null)
            ->where('driver_id', null)
            ->receivedByRestaurant();
        if($limitDrivers&&$limitDrivers > 0){
            $query->where('received_by_restaurant_at','>', now()->subMinutes($limitDrivers));
        }
        $orders = $query->recent()->paginate(config('application.perPage') ?? 20);
        return $this->sendResponse(new OrderCollection($orders), '');
    }
    public function complete(Request $request, Order $order)
    {
        /** @var RestaurantUser $user */
        $user = Auth::user();
        if ($order->status == Order::ACCEPTED && $order->status != Order::COMPLETED && $order->driver_id == $user->id) {
            $order->status = Order::COMPLETED;
            $order->save();
            return $this->sendResponse('', __('Order has been completed successfully'));
        } else {
            return $this->sendError('', __('You do not own this order'));
        }
    }
    public function receive(Request $request, Order $order)
    {
        /** @var RestaurantUser $user */
        $user = Auth::user();
        if ($order->status != Order::COMPLETED && $order->driver_id == null) {
            $order->status = Order::ACCEPTED;
            $order->driver_id = $user->id;
            $order->save();
            return $this->sendResponse('', __('Order has been received successfully'));
        } else {
            return $this->sendError('', __('You do not own this order'));
        }
    }
}
