<?php

namespace App\Http\Requests\Tenant\Customer;

use App\Models\Tenant\DeliveryType;
use Illuminate\Support\Facades\Auth;
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
            'delivery_type'=>'required',
            'shipping_address'=>'nullable',
            'order_notes'=>'nullable',
            'cart'=>'nullable',
            'address'=>'nullable',
            'manual_order_first_name' => 'nullable',
            'manual_order_last_name' => 'nullable',
        ];
    }
    public function withValidator($validator)
    {
        $cart = CartRepository::get();
        $validator->after(function ($validator) use($cart){
            $user = Auth::user();
            if(!$cart->isActiveBranch()){
                $validator->errors()->add('cart', __('This branch is no longer accepting orders'));

            }

            if ($this->payment_method == "Loyalty points") {
                if ($this->delivery_type != DeliveryType::PICKUP){
                    $validator->errors()->add('use_loyalty_points_usage', __('Loyalty points allow with pickup option only'));
                    return;
                }
                if ($user->loyalty_points < $cart->totalLoyaltyPointsPrice()) {
                    $validator->errors()->add('use_loyalty_points_value', __('You do not have enough loyalty points'));
                    return;
                } else if (!$cart->canPayWithLoyaltyPoints()) {
                    $validator->errors()->add('use_loyalty_points_option', __('You can not use loyalty points for place this order'));
                    return;
                }
            }
            if($this->delivery_type == DeliveryType::DELIVERY && (!$this->address || !$user->addresses()?->where('id',$this->address)->count())){
                $validator->errors()->add('address', __('Please update your location or enter customer address before place an order'));
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
                    $validator->errors()->add('cart', __('Coupon applied for only subtotal above :total',['total' => $minimum]).' '.__('SAR'));
                    return ;
                }
            }
            if(!$cart->hasPayment($this->payment_method)){
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

            // Validate if branch is closed
            if($cart->branch()->isClosed())
            {
                $validator->errors()->add('cart', __(':branch is closed',['branch'=> $cart?->branch()?->name]));
                return;
            }
        });
    }



}
