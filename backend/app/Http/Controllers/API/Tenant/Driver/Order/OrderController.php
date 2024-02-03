<?php

namespace App\Http\Controllers\API\Tenant\Driver\Order;

use App\Http\Controllers\Web\BaseController;
use App\Http\Services\tenant\Driver\Order\OrderService;
use App\Models\Tenant\Order;
use Illuminate\Support\Facades\Request;

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
    public function completeOrder(Request $request, Order $order)
    {
        return $this->orderService->complete($request,$order);
    }
    public function receiveOrder(Request $request, Order $order)
    {
        return $this->orderService->receive($request,$order);
    }
}
