<?php

namespace App\Packages\TapPayment\Customer;

use App\Packages\TapPayment\Tap;
use App\Packages\TapPayment\Customer\CustomerInterface;

class Customer extends Tap implements CustomerInterface
{
    public static function create($data):array{
        return self::send('/customers',$data + [
            "currency"=>"SAR"
        ]);
    }
    public static function retrieve(string $customer_id): array {
        return self::send("/customers/$customer_id",[],'get');
    }
}
