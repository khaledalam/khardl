<?php

namespace App\Http\Controllers\Web\Central\Admin\Restaurant;

use App\Http\Controllers\Controller;
use App\Http\Services\Central\Admin\Restaurant\RestaurantService;
use App\Models\Tenant;
use Illuminate\Http\Request;

class RestaurantController extends Controller

{
    public function __construct(private RestaurantService $restaurantService) {
    }
    public function index(Request $request)
    {
        return $this->restaurantService->index($request);
    }
    public function show(Tenant $tenant){
        return $this->restaurantService->show($tenant);
    }
}
