<?php

namespace App\Http\Controllers\Web\Tenant\Coupon;

use App\Http\Controllers\Web\BaseController;
use App\Http\Requests\Tenant\Coupon\CouponStoreFormRequest;
use App\Http\Services\tenant\Coupon\CouponService;
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
}
