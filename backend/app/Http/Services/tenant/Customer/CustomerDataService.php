<?php

namespace App\Http\Services\tenant\Customer;

use App\Models\User;
use App\Traits\APIResponseTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Tenant\RestaurantUser;
class CustomerDataService
{
    use APIResponseTrait;
    public function getList($request)
    {
        /** @var RestaurantUser $user */
        $user  = Auth::user();
        $allCustomers = RestaurantUser::with(['branch'])
        ->Customers()
        ->orderBy('created_at', 'DESC')
        ->paginate(config('application.perPage')??20);
        return view('restaurant.customers_data.list', compact('user','allCustomers'));
    }
    public function show(Request $request,RestaurantUser $restaurantUser)
    {
        /** @var RestaurantUser $user */
        $user  = Auth::user();
        $restaurantUser->load(['branch','recent_orders','recent_orders.branch','recent_orders.delivery_type']);
        $orders = $restaurantUser
        ->recent_orders()
        ->whenSearch($request['search']?? null)
        ->whenStatus($request['status']?? null)
        ->WhenDateString($request['date_string']??null)
        ->whenPaymentStatus($request['payment_status']?? null)
        ->paginate(config('application.perPage')??20);
        return view('restaurant.customers_data.show', compact('user','restaurantUser','orders'));
    }
    public function edit(Request $request,RestaurantUser $restaurantUser)
    {
        return view('restaurant.customers_data.edit', compact('restaurantUser'));
    }
    public function update($request,RestaurantUser $restaurantUser)
    {
        $restaurantUser->update($this->request_data($request));
        return redirect()->route('customers_data.list')->with('success', __('Updated successfully'));
    }
    public function request_data($request)
    {
        return $request->only([
            'first_name',
            'last_name',
            'email',
            'phone',
            'status',
        ]);
    }
}
