<?php

namespace App\Repositories\Customer;


use App\Models\Tenant\Cart;
use App\Models\Tenant\Item;
use App\Models\Tenant\CartItem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Collection;
use App\Http\Requests\Tenant\Customer\AddItemToCartRequest;
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
        $this->createCartItem($item,$request->validated());
        return $this->sendResponse(null, __('The meal has been added successfully.'));
    }
    public function update($request)
    {
        return true;
    }

    public function createCartItem($item,$request):CartItem
    {
        return CartItem::updateOrCreate([
            'item_id' => $item->id,
        ],[
            'cart_id' => $this->cart->id,
            'price' =>$item->price,
            'total' =>$item->price * $request['quantity'] ,
            'quantity' => $request['quantity'],

        ]);
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
        return $this->cart->items()
            ->select('price', 'quantity')
            ->cursor()
            ->reduce(function ($total, $item) {
                return $total + $item->price * $item->quantity;
            }, 0);
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
                options_price : 0,
                total :  $cart_item->total,
            );
        });
    }

   

    public function items()
    {
        $items = $this->cart->items->load(['item']);
        return $this->sendResponse([
            'items'=>$items,
            'payment_methods'=>$this->paymentMethods()
        ], '');
    }


    public function id()
    {
        return $this->cart->id;
    }


    public function paymentMethods(){
        return $this->cart->branch->payment_methods;
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
        }
        // check if cart has branch id
        else if($this->cart->branch_id == $branch_id){
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


}
