<?php

namespace App\Http\Requests\Tenant\Customer;

use Illuminate\Foundation\Http\FormRequest;
use App\Repositories\Customer\CartRepository;

class OrderRequest extends FormRequest
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
            'payment_method'=>'required',
            'shipping_address'=>'nullable',
            'order_notes'=>'nullable',
            'cart'=>'nullable'
        ];
    }
    public function withValidator($validator)
    {
        $cart = CartRepository::get();

        $validator->after(function ($validator) use($cart){
            if(!$cart->hasItems()){
                $validator->errors()->add('cart', __('Cart is empty'));
            }
            if(!$cart->hasPayment($this->payment_method)){
                $validator->errors()->add('payment_method', __('Invalid payment method'));
            }
            
        });
    }

  
}
