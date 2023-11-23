<?php

namespace App\Packages\TapPayment\Business;

use App\Packages\TapPayment\Requests\CreateBusinessRequest;

interface BusinessInterface
{
    public static function create(CreateBusinessRequest $request):array;
    public static function get(string $business_id):array;

}
