<?php

namespace App\Http\Controllers\Web\Tenant\Driver;

use App\Http\Controllers\Web\BaseController;
use App\Http\Requests\Tenant\Coupon\CouponUpdateFormRequest;
use App\Http\Requests\Tenant\Driver\DriverStoreFormRequest;
use App\Http\Requests\Tenant\Driver\DriverUpdateFormRequest;
use App\Http\Services\tenant\Driver\DriverService;
use App\Models\Tenant\Coupon;
use App\Models\Tenant\RestaurantUser;
use Illuminate\Http\Request;

class DriverController extends BaseController
{
    public function __construct(private DriverService $driverService) {
    }
    public function index(Request $request)
    {
        return $this->driverService->index($request);
    }
    public function create(Request $request)
    {
        return $this->driverService->create();
    }
    public function store(DriverStoreFormRequest $request)
    {
        return $this->driverService->store($request);
    }
    public function edit(Request $request, $driver)
    {
        $driver = RestaurantUser::drivers()->findOrFail($driver);
        $this->authorize('update', $driver);
        return $this->driverService->edit($request,$driver);
    }
    public function show(Request $request, $driver)
    {
        $driver = RestaurantUser::drivers()->findOrFail($driver);
        $this->authorize('view', $driver);
        return $this->driverService->show($request,$driver);
    }
    public function update(DriverUpdateFormRequest $request, $driver)
    {
        $driver = RestaurantUser::drivers()->findOrFail($driver);
        $this->authorize('update', $driver);
        return $this->driverService->update($request, $driver);
    }
    public function destroy(Request $request, $driver)
    {
        $driver = RestaurantUser::drivers()->findOrFail($driver);
        $this->authorize('delete', $driver);
        return $this->driverService->destroy($driver);
    }
}
