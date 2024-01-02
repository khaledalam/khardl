<?php

namespace App\Packages\TapPayment\Charge;



interface ChargeInterface
{
    public static function retrieve(string $charge_id):array;

}
