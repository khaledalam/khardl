<?php

namespace App\Http\Controllers\Web\Tenant\Customer;

use App\Http\Controllers\Web\BaseController;
use App\Http\Services\tenant\Customer\CustomerDataService;
use App\Models\Tenant\RestaurantUser;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

class CustomerDataController extends BaseController
{
    public function __construct(
        private CustomerDataService $customerDataService
    ) {

    }
    public function index(Request $request)
    {
       return $this->customerDataService->getList($request);
    }
    public function show(Request $request,RestaurantUser $restaurantUser)
    {
       return $this->customerDataService->show($request,$restaurantUser);
    }
}
