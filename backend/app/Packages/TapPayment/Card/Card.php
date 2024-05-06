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
    public static function delete(string $customer_id,string $card_id) :array {
        return self::send("/card/$customer_id/$card_id",[],'delete');
    }
    public static function retrieve(string $token_id): array {
        return self::send("/tokens/$token_id",[],'get');
    }

}