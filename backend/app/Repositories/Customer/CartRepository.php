<?php

namespace App\Repositories\Customer;


use App\Models\Tenant\Cart;
use App\Models\Tenant\Item;
use App\Models\Tenant\CartItem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Collection;
use App\Http\Requests\Tenant\Customer\AddItemToCartRequest;
use App\Traits\APIResponseTrait;
use Illuminate\Http\JsonResponse;

class CartRepository
{
    /** @var Cart */
    public $cart;
    use APIResponseTrait;

    public  function initiate()
    {   
       if($this->cart) return ;
       $this->cart = Cart::query()->firstOrCreate([
            'user_id' => Auth::id(),
       ]);
    }

    public function add(AddItemToCartRequest $request): JsonResponse
    {
        if(!$this->cart->hasBranch($request->branch_id)){
            return $this->sendError('Fail', 'Cannot add item from different branch.');
        }
        $item = Item::findOrFail($request->item_id);
        $this->createCartItem($item,$request->validated());
        $this->sendResponse(null, __('The meal has been added successfully.'));
    }
    public function update($request)
    {
        return true;
    }
   
    public function createCartItem($item,$request):CartItem
    {
        return CartItem::create([
            'cart_id' => $this->cart->id,
            'price' =>$item->price,
            'item_id' => $item->id,
            'quantity' => $request->quantity,
            'user_id'=> Auth::id()
            
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

    public function remove($id): bool
    {
        return $this->cart->items()
            ->where('id', $id)
            ->delete();
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


    public function items(): Collection
    {
        $this->cart->items->load(['']);

        return $this->cart->items;
    }
   

    public function id()
    {
        return $this->cart->id;
    }

 

}
