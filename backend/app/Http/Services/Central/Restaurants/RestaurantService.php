<?php

namespace App\Http\Services\Central\Restaurants;

use App\Models\Tenant;
use Illuminate\Support\Facades\Auth;

class RestaurantService
{
    public function viewRestaurant(Tenant $tenant)
    {
        $restaurant = $tenant;
        [$logo, $is_live, $orders, $customers] = $this->getRestaurantData($restaurant);

        $owner = $restaurant->user;
        $user = Auth::user();

        return view('admin.Restaurants.Layout.view', compact(
            'restaurant',
            'user',
            'logo',
            'is_live',
            'owner',
            'orders',
            'customers'
        ));
    }

    protected function getRestaurantData(Tenant $restaurant)
    {
        $data = $restaurant->run(function ($restaurant) {
            $info = $restaurant->info(false);

            return [
                $info['logo'],
                $info['is_live'],
                $restaurant->orders(false),
                $restaurant->customers(false),
            ];
        });

        return $data;
    }
}
