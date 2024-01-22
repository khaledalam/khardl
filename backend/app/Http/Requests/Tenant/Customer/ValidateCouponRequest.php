<?php

namespace App\Http\Requests\Tenant\Customer;


use App\Models\Tenant\Coupon;
use App\Models\Tenant\Item;
use App\Repositories\Customer\CartRepository;
use Illuminate\Foundation\Http\FormRequest;

class ValidateCouponRequest extends FormRequest
{

    protected $stopOnFirstFailure = true;

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'code' => [
                'required',
                'string',
                'exists:coupons,code',
                function ($attribute, $value, $fail) {
                    if ($coupon = Coupon::where('code', $value)->first()) {
                        if (!$coupon->validity) {
                            $fail(__('The coupon has been expired'));
                        }
                        if (!$coupon->user_validity) {
                            $fail(__('You have reached the maximum coupon use'));
                        }
                        if ($coupon->minimum_cart_amount) {
                            $cart = (new CartRepository)->initiate();
                            if ($cart->subTotal() < $coupon->minimum_cart_amount) {
                                $fail(__('You must have at least subtotal :subtotal SAR to active this coupon', ['subtotal' => $coupon->minimum_cart_amount]));
                            }
                        }
                    }
                }
            ]
        ];
    }
    public function messages()
    {
        return [
            'code.exists' => __("There is no coupon code for ':code'", ['code' => $this->code])
        ];
    }



}
