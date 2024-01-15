<?php

namespace App\Http\Requests\Tenant\Coupon;

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
            'code' => ['required','string','max:100'],
            'type'  => ['required','in:fixed,percentage'],
            'fixed' => [new RequiredIf($this->type == 'fixed'),'nullable','numeric'],
            'percentage' => [new RequiredIf($this->type == 'percentage'),'nullable','numeric','max:100'],
            'max_use'   => ['nullable','min:0','integer'],
            'max_use_per_user'   => ['nullable','min:0','integer'],
            'max_discount_amount'   => ['nullable','integer'],
            'minimum_cart_amount'   => ['nullable','integer'],
        ];
    }
}
