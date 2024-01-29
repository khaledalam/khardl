<?php

namespace App\Packages\TapPayment\Charge;



interface ChargeInterface
{
    public static function retrieve(string $charge_id,):array;
    public static function create(array $data, string $merchant_id,string $token_id, string $redirect):array;
}
