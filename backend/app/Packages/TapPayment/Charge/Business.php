<?php

namespace App\Packages\TapPayment\Charge;

use App\Packages\TapPayment\Tap;
use App\Packages\TapPayment\Charge\ChargeInterface;

class Charge extends Tap implements ChargeInterface
{
   
    public static function retrieve(string $charge_id): array {
        return self::send("/charges/$charge_id",[],'get');
    }

}