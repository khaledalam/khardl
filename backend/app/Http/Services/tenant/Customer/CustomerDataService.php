<?php

namespace App\Http\Services\tenant\Customer;

use App\Http\Resources\API\Tenant\OrderResource;
use App\Models\Tenant;
use App\Models\Tenant\Order;
use App\Models\User;
use App\Packages\TapPayment\Customer\Customer;
use App\Traits\APIResponseTrait;
use App\Utils\OrdersLocations;
use App\Utils\OrdersLocationsHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Tenant\RestaurantUser;

class CustomerDataService
{
    use APIResponseTrait;
    public function getList($request)
    {
        // @TODO: to remove (this code added to migrate geo address details for old DB data).
        /*
        $restaurants = Tenant::all();
        foreach($restaurants as $restaurant){
            try {
                $restaurant->run(function(){

                    $orders = Order::all();
                    foreach ($orders as $order) {
                        if ($order->lat && $order->lng) {
                            if (!$order->city || !$order->region || !$order->country) {

                                try {
                                    // Reverse geocoding using Google API
                                    list($city, $region, $country) = addressCityRegionCountry($order->lat, $order->lng);

                                    $order->city = $city;
                                    $order->region = $region;
                                    $order->country = $country;

                                    $order->save();
                                } catch (\Exception $e) {
                                }
                            }
                        }
                    }


                    $customers = RestaurantUser::with('addresses')->Customers()->get();
                    foreach ($customers as $customer) {
                        if ($customer->addresses->count()) {
                            foreach ($customer->addresses as $address) {
                                if (!$address->city || !$address->region || !$address->country) {
                                    if (!$address->lat || !$address->lng) {
                                        continue;
                                    }

                                    try {
                                        // Reverse geocoding using Google API
                                        list($city, $region, $country) = addressCityRegionCountry($address->lat, $address->lng);

                                        $address->city = $city;
                                        $address->region = $region;
                                        $address->country = $country;

                                        $address->save();
                                    } catch (\Exception $e) {

                                    }
                                }
                            }
                        }
                    }



                });
                } catch (\Exception $e) {
            }
        }
        */


        /** @var RestaurantUser $user */
        $user  = Auth::user();
        $allCustomers = RestaurantUser::with(['branch',])
        ->Customers()
        ->whenSearch($request['search']??null)
        ->whenStatus($request['status']??null)
        ->orderBy('created_at', 'DESC')
        ->paginate(config('application.perPage')??20);
        $customerStatuses = RestaurantUser::STATUS;

        $customerByLocationByLocation = OrdersLocationsHelper::getCustomerOrdersByLocation($request);

        return view('restaurant.customers_data.list', compact('user','allCustomers','customerStatuses',
            'customerByLocationByLocation'));
    }
    public function show(Request $request,RestaurantUser $restaurantUser)
    {
        /** @var RestaurantUser $user */
        $user  = Auth::user();
        if($restaurantUser->roles()->count()){
            return abort(403);
        }
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
        if($restaurantUser->roles()->count()){
            return abort(403);
        }
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
    public function orders(){
        $user = getAuth();
        return OrderResource::collection($user->orders);
    }
}
