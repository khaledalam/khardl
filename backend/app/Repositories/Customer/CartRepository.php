<?php

namespace App\Repositories\Customer;


use App\Models\Tenant\Cart;
use App\Models\Tenant\Item;
use App\Models\Tenant\Setting;
use App\Models\Tenant\CartItem;
use App\Traits\APIResponseTrait;
use Illuminate\Http\JsonResponse;
use App\Models\Tenant\DeliveryType;
use App\Models\Tenant\PaymentMethod;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Collection;
use App\Http\Requests\Tenant\Customer\AddItemToCartRequest;
use App\Http\Requests\Tenant\Customer\UpdateItemCartRequest;

class CartRepository
{
    /** @var Cart */
    public Cart $cart;
    const VAT_PERCENTAGE = 0;
    use APIResponseTrait;

    public  function initiate($user = null)
    {
        $this->cart = Cart::query()->firstOrCreate([
            'user_id' => $user?? Auth::id(),
        ]);
       return $this;
    }
    public static function get(){
        return app(CartRepository::class);
    }

    public function add(AddItemToCartRequest $request): JsonResponse
    {
        $item = Item::findOrFail($request->item_id);
        if(!$this->hasBranch($request->branch_id) || ( $request->branch_id != $item->branch_id && $this->cart->branch_id != NULL)){
            return $this->sendError(__('Cannot add item from different branch.'));
        }
       
        $this->createCartItem($item, $request->all());
        return $this->data(__('The meal has been added successfully.'));
    }
    public function update(CartItem $cartItem,UpdateItemCartRequest $request)
    {
        $this->updateCartItem($cartItem, $request);
        return $this->data(__('The meal has been updated successfully.'));
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
            $options_price += $this->loopingTroughDropdownOptions($item,$request['selectedDropdown'],$dropdown_options);
        }
        $query = CartItem::where('item_id', $item->id)
        ->where('cart_id', $this->cart->id);
        if($checkbox_options)$query->whereJsonContains('checkbox_options', $checkbox_options);
        if($selection_options)$query->whereJsonContains('selection_options', $selection_options);
        if($dropdown_options)$query->whereJsonContains('dropdown_options', $dropdown_options);
        $existingCartItem = $query->first();
        if ($existingCartItem) {
            $quantity = $existingCartItem->quantity + $request['quantity'];
            $total = ($item->price + $options_price) * $quantity;
            $existingCartItem->update([
                'quantity' => $quantity,
                'total' => $total,
                'notes' => $request['notes'] ?? null,
                'options_price' => $options_price,
                'price' => $item->price,
            ]);
            return $existingCartItem;
        }

        return CartItem::create([
            'item_id' => $item->id,
            'cart_id' => $this->cart->id,
            'price' => $item->price,
            'total' => ($item->price + $options_price) * $request['quantity'],
            'quantity' => $request['quantity'],
            'notes' => $request['notes'] ?? null,
            'options_price' => $options_price,
            'checkbox_options' => $checkbox_options,
            'selection_options' => $selection_options,
            'dropdown_options' => $dropdown_options,
        ]);
    }
    public function loopingTroughCheckboxOptions($item, $options, &$updatedOptions)
    {
        $totalPrice = 0;
        foreach ($options as $i => $option) {
            foreach ($option as $j => $sub_option) {
                if($sub_option!==null){
                    $updatedOptions[$i]['ar'][$item->checkbox_input_titles[$i][1]][] = [$item->checkbox_input_names[$i][$sub_option][1], $item->checkbox_input_prices[$i][$sub_option]];
                    $updatedOptions[$i]['en'][$item->checkbox_input_titles[$i][0]][] = [$item->checkbox_input_names[$i][$sub_option][0], $item->checkbox_input_prices[$i][$sub_option]];
                    $totalPrice += (float) ($item->checkbox_input_prices[$i][$sub_option] ?? 0);
                }
            }
        }
        return $totalPrice;
    }
    public function loopingTroughSelectionOptions($item, $options, &$updatedOptions)
    {
        $totalPrice = 0;
        foreach ($options as $i => $option) {
            if($option!==null){
                $updatedOptions[$i]['ar'][$item->selection_input_titles[$i][1]] = [$item->selection_input_names[$i][$option][1], $item->selection_input_prices[$i][$option]];
                $updatedOptions[$i]['en'][$item->selection_input_titles[$i][0]] = [$item->selection_input_names[$i][$option][0], $item->selection_input_prices[$i][$option]];
                $totalPrice += (float) ($item->selection_input_prices[$i][$option] ?? 0);
            }
        }
        return $totalPrice;
    }
    public function loopingTroughDropdownOptions($item, $options, &$updatedOptions)
    {
        $totalPrice = 0;
        foreach ($options as $i => $option) {
            if($option!==null){
                $updatedOptions[$i]['ar'][$item->dropdown_input_titles[$i][1]] = $item->dropdown_input_names[$i][$option][1];
                $updatedOptions[$i]['en'][$item->dropdown_input_titles[$i][0]] = $item->dropdown_input_names[$i][$option][0];
                $totalPrice += (float) ($item->dropdown_input_prices[$i][$option] ?? 0);
            }
        }
        return $totalPrice;
    }
    public function updateCartItem(CartItem $cartItem, $request)
    {
        $options_price = 0;
        $checkbox_options = null;
        $selection_options = null;
        $dropdown_options = null;
        $updateData = [];
        if($request['selectedCheckbox'] ?? false){
            $options_price += $this->loopingTroughCheckboxOptions($cartItem->item,$request['selectedCheckbox'],$checkbox_options);
        }
        if($request['selectedRadio'] ?? false){
            $options_price += $this->loopingTroughSelectionOptions($cartItem->item,$request['selectedRadio'],$selection_options);
        }
        if($request['selectedDropdown'] ?? false){
            $options_price += $this->loopingTroughDropdownOptions($cartItem->item,$request['selectedDropdown'],$dropdown_options);
        }
        if($options_price!=0){
            $total = ($cartItem->item?->price + $options_price) * $request->input('quantity');
        }else{
            $total = ($cartItem->item?->price + $cartItem->options_price) * $request->input('quantity');
        }

        $updateData = [
            'notes'     => $request->input('notes', $cartItem->notes),
            'quantity'  => $request->input('quantity'),
            'total'     => $total,
        ];

        if ($checkbox_options !== null) {
            $updateData['checkbox_options'] = $checkbox_options;
        }

        if ($selection_options !== null) {
            $updateData['selection_options'] = $selection_options;
        }

        if ($dropdown_options !== null) {
            $updateData['dropdown_options'] = $dropdown_options;
        }

        return $cartItem->update($updateData);
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
            ->where('id', $id)
            ->delete();

        return $this->data(__('The meal has been removed successfully.'));
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
        if (!$this->coupon())
            return 0;
        if (!$this->coupon()->validity || !$this->coupon()->user_validity || $this->subTotal() < $this->coupon()->minimum_cart_amount)
            return 0;
        return $this->coupon()->calculateDiscount($this->subTotal());
    }
    public function coupon()
    {
        return $this->cart?->coupon;
    }
    public function subTotal()
    {
        return $this->cart->refresh()->items->sum('total');
    }

    

    public function tax($subTotal = null)
    {
        $vat = self::VAT_PERCENTAGE;
        if($vat){
            $subTotal = $subTotal ?? $this->subTotal();
            return number_format((($subTotal - $this->discount()) * $vat) / 100 , 2, '.', '');
        }else{
            return 0;
        }
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
        $this->cart->refresh()->items->map(function($cart_item)use($order_id){
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


    public function  totalPriceWithLoyaltyPoints() {
        return  $this->cart->totalPriceWithLoyaltyPoints();
    }
    public function data($message = '')
    {
        $settings = Setting::all()->firstOrFail();
        $items = $this->cart->items->load(['item']);

        $allowPayWithLoyaltyPoints = $this->cart->canPayWithLoyaltyPoints();

        return $this->sendResponse([
            'sub_total' => $this->subTotal(),
            'total' => $this->total(),
            'tax' => $this->tax(),
            'coupon' => $this->coupon(),
            'discount' => $this->discount(),
            'count' => $this->cartCount(),
            'items' => $items,
            'allow_buy_with_loyalty_points' => $allowPayWithLoyaltyPoints,
            'total_price_with_loyalty_points' => (!$allowPayWithLoyaltyPoints ? -1 : $this->cart->totalPriceWithLoyaltyPoints()),
            'payment_methods' => $this->paymentMethods(),
            'delivery_types' => $this->deliveryTypes(),
            'delivery_fee' => $settings['delivery_fee'],
            'tap_information'=> [
                'merchant_id'=>$settings->merchant_id ?? '',
                'tap_customer_id'=>$this->cart?->user?->tap_customer_id,
                "tap_public_key"=>env('TAP_PAYMENT_TECHNOLOGY_NEW_SECRET_KEY_LIVE',''),
                'url_host'=>parse_url(request()->getSchemeAndHttpHost() , PHP_URL_HOST)
            ],
            'address' => $this->cart?->user?->addresses   

        ], $message);
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
        if(!$this->cart?->branch){
            return null;
        }
        $paymentMethods = $this->cart?->branch->payment_methods()->pluck('name')->toArray();

        if($paymentMethods){
            $index = array_search(PaymentMethod::ONLINE, $paymentMethods);
            if ($index !== false) {
                $setting = Setting::first();
                if($setting->merchant_id && $setting->lead_id){
                    return $this->cart?->branch?->payment_methods;
                }else {
                    return $this->cart?->branch->payment_methods()->where('id', '!=', $this->cart?->branch?->payment_methods[$index]->id)->get();
                }
            }
        }

        return $this->cart?->branch?->payment_methods;
    }

    public function deliveryTypes(){
        if(!$this->cart?->branch){
            return null;
        }
        return $this->cart?->branch?->delivery_types;
    }


    public function hasItems():bool{
        return $this->cart->items()->exists();
    }

    public function canPayWithLoyaltyPoints(): bool
    {
        return $this->cart->canPayWithLoyaltyPoints();
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
    public function hasPaymentCashOnDelivery($paymentMethod)
    {
        return $paymentMethod == PaymentMethod::CASH_ON_DELIVERY;
    }

    // Accept online payment method
    public function hasPaymentCreditCard($paymentMethod)
    {
        return  $paymentMethod == PaymentMethod::ONLINE;
    }
    public function hasPaymentLoyaltyPoint($paymentMethod)
    {
        return  $paymentMethod == PaymentMethod::LOYALTY_POINTS;
    }


    public function hasPayment($name)
    {
        if ($name == PaymentMethod::LOYALTY_POINTS) {
            return $this->canPayWithLoyaltyPoints();
        }

        $method = PaymentMethod::where('name',$name)->first();
        $setting = Setting::first();
        if($this->hasPaymentCreditCard($name) && (!$setting->merchant_id || !$setting->lead_id))
            return false;
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
    public function cartCount()
    {
        $totalCount = 0;
        if($this->cart?->items?->count())
            $totalCount = $this->cart?->items?->pluck('quantity')->sum();
        return $totalCount;
    }
    public function count()
    {
        return $this->sendResponse([
            'count' => $this->cartCount()
        ]);
    }
    public function isActiveBranch()
    {
        return $this->cart->branch?->active;
    }


}
