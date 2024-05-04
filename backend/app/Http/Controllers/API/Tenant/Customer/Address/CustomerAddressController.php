<?php

namespace App\Http\Controllers\API\Tenant\Customer\Address;
use App\Http\Requests\API\Customer\Address\CustomerAddressRequest;
use App\Http\Services\API\tenant\Customer\Address\AddressService;
use App\Models\Tenant\UserAddress;
use Illuminate\Http\Request;

class CustomerAddressController
{
    public function __construct(private AddressService $addressService) {
    }
    public function index(Request $request)
    {
        return $this->addressService->index($request);
    }
    public function create(CustomerAddressRequest $request)
    {
        return $this->addressService->create($request);
    }
    public function update(CustomerAddressRequest $request, UserAddress $address)
    {
        return $this->addressService->update($request,$address);
    }
    public function makeDefault(UserAddress $address)
    {
        return $this->addressService->makeDefault($address);
    }
    public function delete(UserAddress $address)
    {
        return $this->addressService->delete($address);
    }
}
