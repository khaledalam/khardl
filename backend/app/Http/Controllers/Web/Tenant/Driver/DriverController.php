<?php

namespace App\Http\Controllers\Web\Tenant\Driver;

use App\Http\Controllers\Web\BaseController;
use App\Http\Requests\Tenant\Coupon\CouponStoreFormRequest;
use App\Http\Requests\Tenant\Coupon\CouponUpdateFormRequest;
use App\Http\Services\tenant\Coupon\CouponService;
use App\Http\Services\tenant\Driver\DriverService;
use App\Models\Tenant\Coupon;
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
    public function store(CouponStoreFormRequest $request)
    {
        return $this->driverService->store($request);
    }
    public function edit(Request $request, Coupon $coupon)
    {
        return $this->driverService->edit($request,$coupon);
    }
    public function update(CouponUpdateFormRequest $request, Coupon $coupon)
    {
        return $this->driverService->update($request, $coupon);
    }
    public function delete(Request $request, Coupon $coupon)
    {
        return $this->driverService->delete($coupon);
    }
}
