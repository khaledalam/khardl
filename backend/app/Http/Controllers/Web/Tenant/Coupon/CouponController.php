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
    public function index(Request $request,$branchId)
    {
        return $this->couponService->index($request,$branchId);
    }
    public function create(Request $request,$branchId)
    {
        return $this->couponService->create($branchId);
    }
    public function store(CouponStoreFormRequest $request,$branchId)
    {
        return $this->couponService->store($request,$branchId);
    }
    public function edit(Request $request, Coupon $coupon,$branchId)
    {
        return $this->couponService->edit($request,$coupon,$branchId);
    }
    public function update(CouponUpdateFormRequest $request, Coupon $coupon,$branchId)
    {
        return $this->couponService->update($request, $coupon,$branchId);
    }
    public function delete(Request $request, Coupon $coupon,$branchId)
    {
        return $this->couponService->delete($coupon,$branchId);
    }
    public function restore(Request $request, Coupon $coupon,$branchId)
    {
        return $this->couponService->restore($coupon,$branchId);
    }
    public function changeStatus(Request $request,Coupon $coupon,$branchId)
    {
        return $this->couponService->changeStatus($coupon,$branchId);
    }
}
