<?php

namespace App\Http\Controllers\Web\Tenant\Driver\Order;

use App\Http\Controllers\Web\BaseController;
use App\Http\Services\tenant\Driver\Order\OrderService;

class OrderController extends BaseController
{
    public function __construct(private OrderService $orderService) {
    }
    public function index()
    {
        return $this->orderService->getList();
    }
    public function ready()
    {
        return $this->orderService->ready();
    }
}
