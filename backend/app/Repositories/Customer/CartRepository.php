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
            return $this->sendError('Fail', 'Cannot add item from different branch.');
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

    public function discount()
    {
        return 0;
        // return $this->cart->discount;
    }

    public function tax()
    {
        return 0;
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

    public function subTotal()
    {
        return $this->cart->items()
            ->select('price', 'quantity')
            ->cursor()
            ->reduce(function ($total, $item) {
                return $total + $item->price * $item->quantity;
            }, 0);
    }

    public function total()
    {
        $total_price = number_format($this->subTotal() - $this->discount() + $this->tax(), 2, '.', '');
        return   $total_price;
    }


    public function items()
    {
        $items = $this->cart->items->load(['item']);
        return $this->sendResponse($items, '');
    }


    public function id()
    {
        return $this->cart->id;
    }



    // Accept Cash on delivery payment method
    public function canCOD()
    {
        $method = PaymentMethod::where('name',PaymentMethod::CASH_ON_DELIVERY)->first();
        if($method){
            return $this->cart->branch->payment_methods->contains('id',$method->id);
        }
        return false;
    }

    // Accept Credit card payment method
    public function canCC()
    {
        $method = PaymentMethod::where('name',PaymentMethod::CREDIT_CARD)->first();
        if($method){
            return $this->cart->branch->payment_methods->contains('id',$method->id);
        }
        return false;
    }


}
