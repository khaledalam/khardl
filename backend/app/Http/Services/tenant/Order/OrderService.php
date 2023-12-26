<?php

namespace App\Http\Services\tenant\Order;

use App\Http\Resources\Web\Tenant\ItemResource;
use App\Models\Tenant\Branch;
use App\Models\Tenant\DeliveryType;
use App\Models\Tenant\Item;
use App\Models\Tenant\Order;
use App\Models\User;
use App\Traits\APIResponseTrait;
use Illuminate\Support\Facades\Auth;
use App\Models\Tenant\RestaurantUser;

class OrderService
{
    use APIResponseTrait;
    public function getList()
    {
        /** @var RestaurantUser $user */
        $user = Auth::user();
        $orders = Order::orderBy('created_at', 'DESC')->paginate(10);
        return view('restaurant.orders.list', compact('user', 'orders'));
    }

    public function create()
    {
        /** @var RestaurantUser $user */
        $user = Auth::user();
        $deliveryTypes = DeliveryType::all();
        $branches   = Branch::all();
        return view('restaurant.orders.add', compact('user','deliveryTypes','branches'));
    }
    public function createOrder($request)
    {
        $user = $this->checkUser($request);
        dd($user);
    }
    public function searchProducts($request)
    {
        $items = Item::whenSearch($request['term']??null)
        ->whenBranch($request['branch_id']??null)
        ->take(5)
        ->get();
        logger($items);
        return $this->sendResponse(ItemResource::collection($items),'');
    }
    private function checkUser($request){
        $user = User::firstOrCreate(
            ['phone' => $request->phone],
            [
                'first_name' => $request->first_name,
                'last_name' => $request->last_name ?? $request->first_name,
                'address' => $request->shipping_address,
            ]
        );
        return $user;
    }
}
