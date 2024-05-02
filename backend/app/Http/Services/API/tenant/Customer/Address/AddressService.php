<?php

namespace App\Http\Services\API\tenant\Customer\Address;

use App\Traits\APIResponseTrait;

class AddressService
{
    use APIResponseTrait;
    public function create($request)
    {
        $data = $this->request_data($request);
        $customer = getAuth();
        $customer->addresses()->create($data);
        return $this->sendResponse($customer->refresh()->addresses()->get(), __('Address has been added successfully.'));
    }
    public function request_data($request)
    {
        return $request->only([
            'address',
            'type',
            'lat',
            'lng'
        ]);
    }
}
