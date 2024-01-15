<?php

namespace App\Http\Services\tenant\Coupon;
use App\Traits\APIResponseTrait;


class CouponService
{
    use APIResponseTrait;
    public function index()
    {
        return view('restaurant.coupons.index');
    }
    public function create()
    {
        return view('restaurant.coupons.create');
    }

}
