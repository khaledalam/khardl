<?php

namespace App\Packages\TapPayment\Business;

use App\Packages\TapPayment\Tap;
use App\Packages\TapPayment\Business\BusinessInterface;
use App\Packages\TapPayment\Requests\CreateBusinessRequest;

class Business extends Tap implements BusinessInterface
{
    public static function create($data):array{
        return self::send('/business',$data);
    }
    public static function get(string $business_id): array {
        return [];
    }

}