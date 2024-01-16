<?php

namespace App\Http\Controllers\Web\Tenant\Coupon;

use App\Http\Controllers\Web\BaseController;
use App\Http\Requests\Tenant\Coupon\CouponStoreFormRequest;
use App\Http\Requests\Tenant\Coupon\CouponUpdateFormRequest;
use App\Http\Services\tenant\Coupon\CouponService;
use App\Models\Tenant\Coupon;
use Illuminate\Http\Request;

class CouponController extends BaseController
{
    public function __construct(private CouponService $couponService) {
    }
    public function index(Request $request)
    {
        return $this->couponService->index();
    }
    public function create(Request $request)
    {
        return $this->couponService->create();
    }
    public function store(CouponStoreFormRequest $request)
    {
        return $this->couponService->store($request);
    }
    public function edit(Request $request, Coupon $coupon)
    {
        return $this->couponService->edit($request,$coupon);
    }
    public function update(CouponUpdateFormRequest $request, $id)
    {
        return $this->couponService->update($request, $id);
    }
    public function changeStatus(Request $request,Coupon $coupon)
    {
        return $this->couponService->changeStatus($coupon);
    }
}
