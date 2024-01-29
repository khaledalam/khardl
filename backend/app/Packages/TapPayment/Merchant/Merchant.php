<?php

namespace App\Packages\TapPayment\Merchant;

use App\Packages\TapPayment\Merchant\MerchantInterface;
use App\Packages\TapPayment\Tap;


class Merchant extends Tap implements MerchantInterface
{

    public static function retrieve(string $merchant_id): array {
        return self::send("/merchant/$merchant_id",[],'get');
    }

}