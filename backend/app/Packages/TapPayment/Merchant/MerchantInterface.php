<?php

namespace App\Packages\TapPayment\Merchant;



interface MerchantInterface
{
    public static function retrieve(string $merchant_id):array;

}
