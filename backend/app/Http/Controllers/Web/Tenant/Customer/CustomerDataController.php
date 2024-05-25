<?php

namespace App\Http\Controllers\Web\Tenant\Customer;

use App\Http\Controllers\Web\BaseController;
use App\Http\Requests\Web\Tenant\Customer\ChangeUserStatusFormRequest;
use App\Http\Requests\Web\Tenant\Customer\UpdateCustomerFormRequest;
use App\Http\Services\tenant\Customer\CustomerDataService;
use App\Models\Tenant\RestaurantUser;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

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
   public function edit(Request $request,RestaurantUser $restaurantUser)
   {
      return $this->customerDataService->edit($request,$restaurantUser);
   }
   public function update(UpdateCustomerFormRequest $request,RestaurantUser $restaurantUser)
   {
      return $this->customerDataService->update($request,$restaurantUser);
   }
   public function update_status(ChangeUserStatusFormRequest $request, RestaurantUser $restaurantUser)
   {
      $restaurantUser->changeStatus($request->status);
      return redirect()->back()->with('success',__('Status changed successfully'));
   }
   public function orders(){
   return $this->customerDataService->orders();
   }
}
