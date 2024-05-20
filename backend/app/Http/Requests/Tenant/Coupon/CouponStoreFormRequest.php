<?php

namespace App\Http\Requests\Tenant\Coupon;

use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\RequiredIf;

class CouponStoreFormRequest extends FormRequest
{
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
            'code' => ['required', 'string', 'max:100', Rule::unique('coupons')->where(function ($query) {
                return $query->where('branch_id', $this->branchId);
            })],
            'type' => ['required', 'in:fixed,percentage'],
            'fixed' => [new RequiredIf($this->type == 'fixed'), 'min:1', 'nullable', 'numeric'],
            'percentage' => [new RequiredIf($this->type == 'percentage'), 'nullable', 'min:1', 'numeric', 'max:100'],
            'max_use' => ['nullable', 'min:0', 'integer'],
            'max_use_per_user' => ['nullable', 'min:0', 'integer'],
            'max_discount_amount' => ['nullable', 'integer'],
            'minimum_cart_amount' => ['nullable', 'numeric'],
            'active_from' => ['required', 'date', 'date_format:Y-m-d', 'after_or_equal:' . date('Y-m-d')],
            'expire_at' => ['required', 'date', 'after_or_equal:active_from', 'date_format:Y-m-d'],
        ];
    }
    public function messages()
    {
        return [
            'active_from.after'=>__("Cannot select date in the past")
        ];
    }
}
