<?php

namespace App\Http\Controllers\Web\Tenant;

use App\Http\Controllers\Controller;
use App\Models\Tenant\RestaurantStyle;
use App\Models\Tenant\Setting;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $logo = RestaurantStyle::first()?->logo;
        $restaurant_name = Setting::first()->restaurant_name;


        return match(true){
            $user->isRestaurantOwner() => redirect()->route('restaurant.summary'),
            $user->isWorker() => redirect()->route('restaurant.branches'),
            default => view('tenant', compact('logo', 'restaurant_name'))
        };
    }
}
