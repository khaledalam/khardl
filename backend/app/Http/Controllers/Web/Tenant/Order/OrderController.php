<?php

namespace App\Http\Controllers\Web\Tenant\Order;

use App\Http\Requests\Web\Tenant\Order\StoreOrderFormRequest;
use App\Http\Services\tenant\Order\OrderService;
use App\Http\Controllers\Web\BaseController;
use App\Models\Tenant\Item;
use App\Models\Tenant\Product;
use Illuminate\Http\Request;

class OrderController extends BaseController
{
    public function __construct(private OrderService $orderService) {
    }
    public function index(Request $request)
    {
        return $this->orderService->getList($request);
    }

    public function inquiry(Request $request)
    {
        return $this->orderService->inquiry($request);
    }
    public function create()
    {
        return $this->orderService->create();
    }
    public function searchProducts(Request $request)
    {
        return $this->orderService->searchProducts($request);
    }
    public function getProduct(Request $request,Item $item)
    {
        return $this->orderService->getProduct($request,$item);
    }
    public function store(StoreOrderFormRequest $request)
    {
        return $this->orderService->addOrder($request);
    }
    public function UnavailableProducts(Request $request){
        return $this->orderService->listUnavailableProducts($request);
    }
    public function changeProductAvailability(Request $request,Item $item){
        $this->orderService->changeProductAvailability($item);
        return $this->sendResponse('', '');
    }
}
