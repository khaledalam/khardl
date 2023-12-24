<?php

namespace App\Http\Controllers\Web\Tenant\Order;

use App\Http\Services\tenant\Order\OrderService;
use App\Http\Controllers\Web\BaseController;
use Illuminate\Http\Request;

class OrderController extends BaseController
{
    public function __construct(private OrderService $orderService) {
    }
    public function index()
    {
        return $this->orderService->getList();
    }

    public function create()
    {
        return $this->orderService->create();
    }
    public function searchProducts(Request $request)
    {
        return $this->orderService->searchProducts($request);
    }
}
