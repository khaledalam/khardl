<?php

namespace App\Http\Controllers\Web\Tenant\OurServices;

use App\Http\Services\tenant\OurServices\OurServicesService;
use App\Http\Controllers\Web\BaseController;


class OurServicesController extends BaseController
{
    public function __construct(
        private OurServicesService $ourServicesService
    ) {
    }
    public function services()
    {
        return $this->ourServicesService->services();
    }
    public function deactivate()
    {
        return $this->ourServicesService->deactivate();
    }
    public function appDeactivate()
    {
        return $this->ourServicesService->appDeactivate();
    }
    public function activate()
    {
        return $this->ourServicesService->activate();
    }
    public function appActivate()
    {
        return $this->ourServicesService->appActivate();
    }
    public function calculate($type, $number_of_branches,$subscription_id)
    {
        return $this->ourServicesService->calculate($type, $number_of_branches,$subscription_id);
    }
    public function coupon($coupon,$type,$number_of_branches = null)
    {
        return $this->ourServicesService->coupon($coupon,$type,$number_of_branches = null);
    }

}
