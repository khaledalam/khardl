<?php

namespace App\Packages\TapPayment\Charge;

use App\Packages\TapPayment\Tap;
use App\Packages\TapPayment\Charge\ChargeInterface;
use Illuminate\Support\Facades\Auth;

class Charge extends Tap implements ChargeInterface
{
    public static function create(array $data, string $merchant_id,string $token_id,string $redirect): array {
        return self::send("/charges",[
            'currency'=>"SAR",
            'customer_initiated'=> true,
            'threeDSecure'=>true,
            'save_card'=>false,
            'receipt'=>[
                'email'=>true,
                'sms'=>true
            ],
            'customer'=>[
                'id'=> Auth::user()->tap_customer_id,
            ],
            'merchant_id'=>[
                'id'=>$merchant_id
            ],
            'source'=>[
                'id'=>$token_id
            ],
            'platform'=>[
                env('TAP_PLATFORM_ID')
            ],
            'post'=>[
                'url'=>route('webhook-client-tap-payment')
            ],
            "source"=>[
                "id"=>"src_all"
            ],
            'redirect'=>[
                'url'=>$redirect 
            ] 
            
            
        ]+ $data);
    }
    public static function createSub(array $data,string $token_id,string $redirect): array {
        return self::sendToSub("/charges",[
            'currency'=>"SAR",
            'customer_initiated'=> true,
            'threeDSecure'=>true,
            'save_card'=>false,
            'receipt'=>[
                'email'=>true,
                'sms'=>true
            ],
            'customer'=>[
                'id'=> env('TAP_DEFAULT_CUSTOMER_ID',''),
            ],
            
            'source'=>[
                'id'=>$token_id
            ],
            'post'=>[
                'url'=>route('webhook-client-tap-payment')
            ],
            "source"=>[
                "id"=>"src_all"
            ],
            'redirect'=>[
                'url'=>$redirect 
            ] 
            
            
        ]+ $data);
    }
    public static function retrieve(string $charge_id): array {
        return self::send("/charges/$charge_id",[],'get');
    }
    public static function retrieveSub(string $charge_id): array {
        return self::sendToSub("/charges/$charge_id",[],'get');
    }
    
    

}