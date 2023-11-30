<?php

namespace App\Http\Controllers\API\Tenant\Customer;

use App\Traits\APIResponseTrait;
use App\Repositories\Customer\CartRepository;
use App\Http\Requests\Tenant\Customer\AddItemToCartRequest;

class CartController
{
    use APIResponseTrait;
    public function store(AddItemToCartRequest $request,CartRepository $cart)
    {
        if ($cart->add($request)) {
            return $this->sendResponse(null, __('The meal has been added successfully.'));
        }
        return $this->sendError('Fail', 'Error adding items to cart.');
    }

    public function edit($id)
    {
       
    }

  
    public function update()
    {
        
    }

   
    public function destroy()
    {
       
    }
}
