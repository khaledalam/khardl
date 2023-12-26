<?php

namespace App\Packages\TapPayment\Subscription;

use App\Packages\TapPayment\Tap;
use App\Packages\TapPayment\Subscription\SubscriptionInterface;

class Subscription extends Tap implements SubscriptionInterface
{
    public static function create($data):array{
        return self::send('/subscription/v1',$data + [
            'term'=> [
                
            ]
        ]);
    }
    public static function retrieve(string $business_id): array
    {
        return [];
    }
}
