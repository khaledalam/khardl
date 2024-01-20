<?php

namespace App\Http\Controllers\API\Tenant\Customer;

use App\Http\Requests\Tenant\Customer\ValidateCouponRequest;
use App\Models\Tenant\Coupon;
use App\Repositories\Customer\CartRepository;
use App\Traits\APIResponseTrait;


class CouponController
{
    use APIResponseTrait;

    public function validateCoupon(ValidateCouponRequest $request)
    {
        $cart = (new CartRepository)->initiate();
        $subTotal = $cart->subTotal();
        $coupon = Coupon::where('code', $request->code)->first();
        $discount = $coupon->calculateDiscount($subTotal);
        $cart->cart->update(['coupon_id' => $coupon->id]);
        return $this->sendResponse([
            'discount' => $discount,
            'discount_type' => $coupon->type,
            'minimum_cart_amount' => $coupon->minimum_cart_amount,
            'max_discount_amount' => $coupon->max_discount_amount,
            'after_total' => ($subTotal - $discount) > 0 ? $subTotal - $discount : 0
        ], __('Coupon has been applied'));
    }
}
