<?php

namespace App\Packages\TapPayment\Refund;



interface RefundInterface
{
    public static function create(array $data):array;
}
