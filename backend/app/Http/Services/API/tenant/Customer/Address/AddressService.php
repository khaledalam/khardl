<?php

namespace App\Http\Services\API\tenant\Customer\Address;

use App\Models\Tenant\Branch;
use App\Traits\APIResponseTrait;

class AddressService
{
    use APIResponseTrait;
    protected $customer;
    public function __construct()
    {
        $this->customer = getAuth();
    }
    public function index($request)
    {
        return $this->sendResponse($this->customer->addresses()->get(), '');
    }
    public function getDefault()
    {
        return $this->sendResponse($this->customer->default_address(), '');
    }
    public function create($request)
    {
        $data = $this->request_data($request);

        // Reverse geocoding using Google API
        list($city, $region, $country) = addressCityRegionCountry($data['lat'], $data['lng']);

        $data['city'] = $city;
        $data['region'] = $region;
        $data['country'] = $country;

        $this->customer->addresses()->create($data);
        return $this->sendResponse($this->customer->refresh()->addresses()->get(), __('Created successfully'));
    }

    public function update($request,$address)
    {
        $data = $this->request_data($request);

        // Reverse geocoding using Google API
        list($city, $region, $country) = addressCityRegionCountry($data['lat'], $data['lng']);

        $data['city'] = $city;
        $data['region'] = $region;
        $data['country'] = $country;

        $this->customer
        ->addresses()
        ->findOrFail($address->id)
        ->update($data);
        return $this->sendResponse($this->customer->refresh()->addresses()->get(), __('Updated successfully'));
    }
    public function makeDefault($address)
    {
        $this->customer
        ->addresses()
        ->update(['default' => false]);
        $address->update(['default' => true]);
        return $this->sendResponse($this->customer->refresh()->addresses()->get(), __('Updated successfully'));
    }
    public function delete($address)
    {
        $this->customer
        ->addresses()
        ->findOrFail($address->id)
        ->delete();
        return $this->sendResponse($this->customer->refresh()->addresses()->get(), __('Deleted successfully'));
    }
    public function checkBranchScope($request,Branch $branch)
    {
        $distance = haversineDistance((float)$request->lat, (float)$request->lng, (float)$branch->lat, (float)$branch->lng);
        $is_far = $distance > config('application.branch_max_scope', 15);
        return $this->sendResponse([
            'distance' => $distance,
            'is_far' => $is_far
        ], __('Distance scope'));
    }
    public function request_data($request)
    {
        return $request->only([
            'address',
            'type',
            'lat',
            'lng',
            'name'
        ]);
    }


}
