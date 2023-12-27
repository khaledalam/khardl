<?php

namespace App\Http\Services\tenant\Customer;

use App\Models\User;
use App\Traits\APIResponseTrait;
use Illuminate\Support\Facades\Auth;
use App\Models\Tenant\RestaurantUser;
class CustomerDataService
{
    use APIResponseTrait;
    public function getList($request)
    {
        /** @var RestaurantUser $user */
        $user  = Auth::user();
        $allCustomers = RestaurantUser::with(['branch'])->Customers()->orderBy('created_at', 'DESC')->paginate(config('application.perPage'));
        return view('restaurant.customers_data.list', compact('user','allCustomers'));
    }
    public function show($request,RestaurantUser $restaurantUser)
    {
        /** @var RestaurantUser $user */
        $user  = Auth::user();
        return view('restaurant.customers_data.show', compact('user','restaurantUser'));
    }
}
