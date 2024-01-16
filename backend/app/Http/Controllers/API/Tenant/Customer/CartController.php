<?php

namespace App\Http\Controllers\API\Tenant\Customer;

use App\Traits\APIResponseTrait;
use App\Repositories\Customer\CartRepository;
use App\Http\Requests\Tenant\Customer\AddItemToCartRequest;
use App\Http\Requests\Tenant\Customer\RemoveItemToCartRequest;
use App\Http\Requests\Tenant\Customer\UpdateItemCartRequest;
use App\Models\Tenant\CartItem;

class CartController
{
    use APIResponseTrait;
    protected $cart;
    public function __construct()
    {
        $this->cart = CartRepository::get();
    }
    public function index(){
        return $this->cart->data();
    }
    public function store(AddItemToCartRequest $request)
    {
        return $this->cart->add($request);
    }
   

    public function edit($id)
    {
       
    }

  
    public function update(CartItem $cart,UpdateItemCartRequest $request)
    {
        return $this->cart->update($cart,$request);
    }

    public function destroy($item)
    {   
        return $this->cart->remove($item);
    }
    public function trash()
    {   
        return $this->cart->trash();
    }
}
