<?php

namespace App\Packages\TapPayment\Customer;

use App\Packages\TapPayment\Requests\CreateCustomerRequest;

interface CustomerInterface
{
    public static function create(CreateCustomerRequest $request):array;
    public static function retrieve(string $customer_id):array;
}
