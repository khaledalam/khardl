<?php

namespace App\Http\Services\API\tenant\Driver\Order;

use App\Models\Tenant\Order;
use App\Traits\APIResponseTrait;
use Illuminate\Support\Facades\Auth;
use App\Models\Tenant\RestaurantUser;
use App\Http\Resources\API\Tenant\Collection\Driver\OrderCollection;
use Illuminate\Support\Facades\Request;

class OrderService
{
    use APIResponseTrait;
    public function getList()
    {
        /** @var RestaurantUser $user */
        $user = Auth::user();
        $orders = Order::with('payment_method')
            ->where('driver_id', $user->id)
            /* TODO: status , completed, rejected */
            ->delivery()
            ->recent()
            ->paginate(config('application.perPage') ?? 20);
        return $this->sendResponse(new OrderCollection($orders), '');
    }
    public function ready()
    {
        $orders = Order::with('payment_method')->delivery()
            ->where('deliver_by', null)
            ->where('driver_id', null)
            ->receivedByRestaurant()
            /*
            (add in setting)
            Less thant 5 min (update_at)
            add column received_at
            */
            ->recent()
            ->paginate(config('application.perPage') ?? 20);
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
