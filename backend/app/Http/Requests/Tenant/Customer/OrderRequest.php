<?php

namespace App\Http\Requests\Tenant\Customer;

use App\Models\Tenant\Coupon;
use App\Models\Tenant\DeliveryType;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;
use App\Repositories\Customer\CartRepository;
use App\Packages\DeliveryCompanies\DeliveryCompanies;

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
            'delivery_type'=>'required',
            'shipping_address'=>'nullable',
            'order_notes'=>'nullable',
            'cart'=>'nullable',
            'address'=>'nullable',
        ];
    }
    public function withValidator($validator)
    {

        $cart = CartRepository::get();

        $validator->after(function ($validator) use($cart){

            $user = Auth::user();
            if(!$user->address || !$user->lat || !$user->lng){
                $validator->errors()->add('address', __('Please update your location before place an order'));
                return ;
            }
            if(!$cart->hasItems()){
                $validator->errors()->add('cart', __('Cart is empty'));
                return ;
            }
            if($cart->coupon()){
                if (!$cart->coupon()->validity){
                    $validator->errors()->add('cart', __('Coupon has been expired'));
                    return ;
                }
                if (!$cart->coupon()->user_validity){
                    $validator->errors()->add('cart', __('You reached the maximum uses for coupon'));
                    return ;
                }
                if ($cart->subTotal() < $minimum = $cart->coupon()->minimum_cart_amount){
                    $validator->errors()->add('cart', __('Coupon applied for only subtotal above :total',['total' => $minimum]).' '.__('messages.SAR'));
                    return ;
                }
            }
            if(!$cart->hasPaymentCreditCardWithTap($this->payment_method)){
                $validator->errors()->add('payment_method', __('Invalid payment method'));
                return ;
            }
           
            if(!$cart->hasDelivery($this->delivery_type)){
                $validator->errors()->add('delivery_type', __('Invalid Delivery Type'));
                return ;
            }

            $cart->items()->map(function($cart_item)use($validator){
                if(!$cart_item->item->availability){
                    $validator->errors()->add('cart', __(':name is not available',['name'=>$cart_item->item->name]));
                    return ;
                }
            });
            // if($this->delivery_type == DeliveryType::DELIVERY ){
            //     $branch = $cart->branch();
            //     DeliveryCompanies::validateCustomerAddress($validator,$branch->lat,$branch->lng,$user->lat,$user->lng);
            // }

        });
    }



}
