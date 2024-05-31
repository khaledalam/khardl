<?php

namespace App\Http\Controllers\Web\Central\Admin\RestaurantOwner;

use App\Http\Controllers\Controller;
use App\Http\Requests\Central\RestaurantOwner\CreateROFormRequest;
use App\Http\Requests\Central\RestaurantOwner\UpdateROFormRequest;
use App\Http\Services\Central\Admin\RestaurantOwner\RestaurantOwnerService;
use App\Models\User;
use Illuminate\Http\Request;

class RestaurantOwnerController extends Controller
{

    public function __construct(private RestaurantOwnerService $restaurantOwnerService) {
    }
    public function show(Request $request, User $user)
    {
        return $this->restaurantOwnerService->show($request, $user);
    }
    public function update(UpdateROFormRequest $request, User $user)
    {
        return $this->restaurantOwnerService->update($request, $user);
    }
    public function create(Request $request)
    {
        return $this->restaurantOwnerService->create($request);
    }
    public function store(CreateROFormRequest $request)
    {
        return $this->restaurantOwnerService->store($request);
    }
}
