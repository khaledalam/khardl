<?php

namespace App\Repositories\Customer;


use App\Models\Tenant\Cart;
use App\Models\Tenant\Item;
use App\Models\Tenant\CartItem;
use App\Models\Tenant\Setting;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Collection;
use App\Http\Requests\Tenant\Customer\AddItemToCartRequest;
use App\Models\Tenant\DeliveryType;
use App\Models\Tenant\PaymentMethod;
use App\Traits\APIResponseTrait;
use Illuminate\Http\JsonResponse;

class CartRepository
{
    /** @var Cart */
    public $cart;
    const VAT_PERCENTAGE = 15;
    use APIResponseTrait;

    public  function initiate()
    {
        $this->cart = Cart::query()->firstOrCreate([
            'user_id' => Auth::id(),
        ]);
       return $this;
    }
    public static function get(){
        return app(CartRepository::class);
    }

    public function add(AddItemToCartRequest $request): JsonResponse
    {
        if(!$this->hasBranch($request->branch_id)){
            return $this->sendError('Fail', __('Cannot add item from different branch.'));
        }
        $item = Item::findOrFail($request->item_id);
        $this->createCartItem($item, $request->validated());
        return $this->sendResponse(null, __('The meal has been added successfully.'));
    }
    public function update($request)
    {
        return true;
    }

    public function createCartItem($item,$request):CartItem
    {   
        $checkbox_options = null;
        $selection_options = null;
        $dropdown_options = null;
        $options_price = 0;
        if($request['selectedCheckbox'] ?? false){
            $options_price += $this->loopingTroughCheckboxOptions($item,$request['selectedCheckbox'],$checkbox_options);
        }
        if($request['selectedRadio'] ?? false){
            $options_price += $this->loopingTroughSelectionOptions($item,$request['selectedRadio'],$selection_options);
        }
        if($request['selectedDropdown'] ?? false){
            $this->loopingTroughDropdownOptions($item,$request['selectedDropdown'],$dropdown_options);
        }
        return CartItem::updateOrCreate([
            'item_id' => $item->id,
        ],[
            'cart_id' => $this->cart->id,
            'price' =>$item->price,
            'total' =>($item->price + $options_price) * $request['quantity'] ,
            'quantity' => $request['quantity'],
            'notes' => $request['notes'],
            'options_price'=>$options_price,
            'checkbox_options'=>$checkbox_options,
            'selection_options'=>$selection_options,
            'dropdown_options'=>$dropdown_options,
        ]);
    }
    public function loopingTroughCheckboxOptions($item,$options,&$updatedOptions){
        $totalPrice = 0;
        foreach($options as $i=>$option){
            foreach($option as $j=>$sub_option){
                $updatedOptions [$item->checkbox_input_titles[$i]][] = [$item->checkbox_input_names[$i][$j],$item->checkbox_input_prices[$i][$j]];
                $totalPrice += (float) $item->checkbox_input_prices[$i][$j];
            }   
        } 
        return  $totalPrice;
    }
    public function loopingTroughSelectionOptions($item,$options,&$updatedOptions){
        $totalPrice = 0;
        foreach($options as $i=>$option){
            if($option)
                foreach($option as $j=>$sub_option){
                    $updatedOptions [$item->selection_input_titles[$i]] = [$item->selection_input_names[$i][$j],$item->selection_input_prices[$i][$j]];
                    $totalPrice += (float) $item->selection_input_prices[$i][$j];
                }   
        } 
        return  $totalPrice;
    }
    public function loopingTroughDropdownOptions($item,$options,&$updatedOptions){
        foreach($options as $i=>$option){
            if($option)
                foreach($option as $j=>$sub_option){
                    $updatedOptions [$item->dropdown_input_titles[$i]] = $item->dropdown_input_names[$i][$j];
                }   
        } 
    }
    public function updateCartItem(CartItem $cartItem, $request)
    {
        return $cartItem->update([
            'price'     => $cartItem->item->price,
            'quantity'  => $request->quantity,
        ]);
    }

    public function setQuantity($id, $quantity)
    {
        return $this->cart->items()
            ->where('id', $id)
            ->update([
                'quantity' => $quantity
            ]);
    }
    public function remove($id): JsonResponse
    {
        $this->cart->items()
            ->where('item_id', $id)
            ->delete();
        return $this->sendResponse(null, __('The meal has been removed successfully.'));
    }

    public function trash(): JsonResponse
    {
        $this->cart->delete();
        return $this->sendResponse(null, __('Cart items has been removed successfully.'));
    }
    public function UpdateTotalCartPrice()
    {
        $this->cart->total = $this->cart->items->sum('total');
        // $this->cart->total+= $this->cart->global_options->sum('price');
        $this->cart->save();
    }
    public function discount()
    {
        return 0;
        // return $this->cart->discount;
    }

    public function subTotal()
    {
        return $this->cart->items->sum('total');
    }
    public function tax($subTotal = null)
    {

        $vat = self::VAT_PERCENTAGE;

        return number_format((($subTotal ?? $this->subTotal() - $this->discount()) * $vat) / 100 , 2, '.', '');
    }
    public function total($subTotal = null)
    {
        $subTotal = $subTotal ?? $this->subTotal();
        return number_format($subTotal - $this->discount() + $this->tax($subTotal), 2, '.', '');
    }

    public function branch()
    {
        return $this->cart->branch;
    }
    public function updatePaymentMethod($payment_method_id):void{
        $this->cart->payment_method_id = $payment_method_id;
        $this->cart->save();
    }


    public function clone_to_order_items($order_id):void {
        $this->cart->items->map(function($cart_item)use($order_id){
            OrderRepository::clone_cart_items(
                order_id : $order_id,
                item_id : $cart_item->item_id,
                quantity : $cart_item->quantity,
                price : $cart_item->price,
                options_price : $cart_item->options_price,
                total :  $cart_item->total,
                notes: $cart_item->notes,
                checkbox_options:$cart_item->checkbox_options,
                selection_options:$cart_item->selection_options,
                dropdown_options:$cart_item->dropdown_options,
            );
        });
    }



    public function data()
    {
        $settings = Setting::all()->firstOrFail();
        $items = $this->cart->items->load(['item']);
        return $this->sendResponse([
            'items' => $items,
            'payment_methods' => $this->paymentMethods(),
            'delivery_types' => $this->deliveryTypes(),
            'delivery_fee' => $settings['delivery_fee'],
            'address' => $this->cart->user()->firstOrFail()?->address
        ], '');
    }
    public function items()
    {
        $items = $this->cart->items->load(['item']);
        return $items;
    }


    public function id()
    {
        return $this->cart->id;
    }


    public function paymentMethods(){
        return $this->cart?->branch?->payment_methods;
    }

    public function deliveryTypes(){
        return $this->cart?->branch?->delivery_types;
    }


    public function hasItems():bool{
        return $this->cart->items()->exists();
    }
    public function hasBranch($branch_id){
        // check if cart has branch or not
        if($this->cart->branch_id == null){
            $this->cart->branch_id = $branch_id;
            $this->cart->save();
            return true;
        } else if($this->cart->branch_id == $branch_id){ // check if cart has branch id
            return true;
        }else if (!$this->hasItems()){ // if cart has no items we can switch to that branch
            $this->cart->branch_id = $branch_id;
            $this->cart->save();
            return true;
        }
        return false;
    }
    // Accept Cash on delivery payment method
    public function hasPaymentCashOnDelivery()
    {
        $method = PaymentMethod::where('name',PaymentMethod::CASH_ON_DELIVERY)->first();
        if($method){
            return $this->cart->branch->payment_methods->contains('id',$method->id);
        }
        return false;
    }

    // Accept Credit card payment method
    public function hasPaymentCreditCard()
    {
        $method = PaymentMethod::where('name',PaymentMethod::CREDIT_CARD)->first();
        if($method){
            return $this->cart->branch->payment_methods->contains('id',$method->id);
        }
        return false;
    }

    public function hasPayment($name)
    {
        $method = PaymentMethod::where('name',$name)->first();
        if($method){
            return $this->cart->branch->payment_methods->contains('id',$method->id);
        }
        return false;
    }

    public function hasDelivery($type)
    {
        $type = DeliveryType::where('name',$type)->first();
        if($type){
            return $this->cart->branch->delivery_types->contains('id',$type->id);
        }
        return false;
    }


}
