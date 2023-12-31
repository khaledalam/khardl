<?php

namespace App\Http\Controllers;

use App\Http\Services\Central\Restaurants\RestaurantService;
use App\Models\Tenant;
use Illuminate\Support\Facades\Auth;

class RestaurantController extends Controller
{
    public function __construct(private RestaurantService $restaurantService) {
    }
    public function viewRestaurant(Tenant $tenant){
        return $this->restaurantService->viewRestaurant($tenant);
    }
}
