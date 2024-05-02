<?php

namespace App\Http\Controllers\API\Tenant\Customer\Address;
use App\Http\Requests\API\Customer\Address\CreateCustomerAddressRequest;
use App\Http\Services\API\tenant\Customer\Address\AddressService;

class CustomerAddressController
{
    public function __construct(private AddressService $addressService) {
    }
    public function create(CreateCustomerAddressRequest $request)
    {
        return $this->addressService->create($request);
    }
}
