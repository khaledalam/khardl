<?php

namespace App\Packages\TapPayment\Card;

use App\Packages\TapPayment\Tap;
use App\Packages\TapPayment\Card\CardInterface;

class Card extends Tap implements CardInterface
{
    public static function create($data):array{
        return self::send('/tokens',$data + [
            "metadata"=>[
                "mtd"=>"metadata"
            ],
        ]);
    }


}