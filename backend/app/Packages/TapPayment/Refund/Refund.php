<?php

namespace App\Packages\TapPayment\Refund;

use App\Packages\TapPayment\Tap;
use App\Packages\TapPayment\Charge\ChargeInterface;
use Illuminate\Support\Facades\Auth;

class Refund extends Tap implements RefundInterface
{
    public static function create(array $data,string $merchant_id): array {
        return self::send("/refunds",[
            'currency'=>"SAR",
            'merchant'=>[
                'id'=>$merchant_id
            ],
            'platform'=>[
                'id'=>env('TAP_PLATFORM_ID')
            ],
            'post'=>[
                'url'=>route('webhook-client-tap-payment')
            ],
        ]+ $data);
    }
    
}