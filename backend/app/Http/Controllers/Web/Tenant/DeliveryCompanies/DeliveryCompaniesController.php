<?php

namespace App\Http\Controllers\Web\Tenant\DeliveryCompanies;

use App\Http\Controllers\Web\BaseController;
use App\Http\Services\tenant\DeliveryCompanies\DeliveryService;
use Illuminate\Http\Request;

class DeliveryCompaniesController extends BaseController
{
    public function __construct(
        private DeliveryService $deliveryService
    ) {

    }
    public function delivery(Request $request)
    {
       return $this->deliveryService->getDeliveryCompanies($request);
    }
    public function toggleActivation($module, Request $request)
    {
       return $this->deliveryService->toggleActivation($module,$request);
    }
}
