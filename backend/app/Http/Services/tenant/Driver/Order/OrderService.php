<?php

namespace App\Http\Services\tenant\Driver\Order;

use App\Models\Tenant\Order;
use App\Traits\APIResponseTrait;
use Illuminate\Support\Facades\Auth;
use App\Models\Tenant\RestaurantUser;
use App\Http\Resources\API\Tenant\Collection\Driver\OrderCollection;

class OrderService
{
    use APIResponseTrait;
    public function getList()
    {
        /** @var RestaurantUser $user */
        $user = Auth::user();
        $orders = Order::with('payment_method')
        ->where('driver_id',$user->id)
        ->delivery()
        ->recent()
        ->paginate(config('application.perPage')??20);
        return $this->sendResponse(new OrderCollection($orders),'');
    }
    public function ready()
    {
        $orders = Order::with('payment_method')->delivery()
        ->where('deliver_by', null)
        ->where('driver_id',null)
        ->ready()
        ->recent()
        ->paginate(config('application.perPage')??20);
        return $this->sendResponse(new OrderCollection($orders),'');
    }
}
