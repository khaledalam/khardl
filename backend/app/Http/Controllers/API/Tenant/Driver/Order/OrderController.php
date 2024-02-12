<?php

namespace App\Http\Controllers\API\Tenant\Driver\Order;

use App\Http\Controllers\Web\BaseController;

use App\Http\Requests\API\Driver\Order\ChangeStatusRequest;
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
    public function changeStatus(ChangeStatusRequest $request, Order $order)
    {
        return $this->orderService->changeStatus($request,$order);
    }
    public function assignOrder(Request $request, Order $order)
    {
        return $this->orderService->assignOrder($request,$order);
    }
}
