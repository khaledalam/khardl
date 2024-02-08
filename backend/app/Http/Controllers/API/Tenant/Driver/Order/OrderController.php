<?php

namespace App\Http\Controllers\API\Tenant\Driver\Order;

use App\Http\Controllers\Web\BaseController;

use App\Http\Services\API\tenant\Driver\Order\OrderService;
use App\Models\Tenant\Order;
use Illuminate\Http\Request;


class OrderController extends BaseController
{
    public function __construct(private OrderService $orderService) {
    }
    public function index(Request $request)
    {
        return $this->orderService->getList($request);
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
