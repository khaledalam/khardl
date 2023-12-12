<?php

namespace App\Http\Controllers\API\Tenant\Customer;

use App\Traits\APIResponseTrait;
use App\Repositories\Customer\CartRepository;
use App\Http\Requests\Tenant\Customer\AddItemToCartRequest;
use App\Http\Requests\Tenant\Customer\RemoveItemToCartRequest;

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

  
    public function update()
    {
        
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
