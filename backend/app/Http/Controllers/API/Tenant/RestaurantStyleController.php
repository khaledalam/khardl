<?php

namespace App\Http\Controllers\API\Tenant;

use App\Http\Controllers\Controller;
use App\Http\Requests\Tenant\RestaurantControllerRequest;
use App\Http\Services\API\tenant\RestaurantStyleService;
use Illuminate\Support\Facades\Request;
class RestaurantStyleController extends Controller
{
    public function __construct(private RestaurantStyleService $restaurantStyleService)
    {

    }
    public function save(RestaurantControllerRequest $request)
    {
        return $this->restaurantStyleService->save($request);
    }
    public function fetch(Request $request)
    {
       return $this->restaurantStyleService->fetch($request);
    }

}
