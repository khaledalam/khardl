<?php

namespace App\Http\Controllers\API\Tenant\Customer;

use App\Traits\APIResponseTrait;
use App\Repositories\Customer\CartRepository;
use App\Repositories\Customer\OrderRepository;
use App\Http\Requests\Tenant\Customer\OrderRequest;

class OrderController
{
    use APIResponseTrait;
    protected $cart;
    protected $order;
    // Dependency injection not work with http client-server, Axios
    public function __construct()
    {
        $this->cart = CartRepository::get();
        $this->order = new OrderRepository();
    }
    public function store(OrderRequest $request)
    {
        return $this->order->create($request,$this->cart);
    }

    public function index(){
        return $this->sendResponse($this->order, '');
    }


}
