<?php

namespace App\Packages\TapPayment\Card;

use App\Packages\TapPayment\Requests\CreateBusinessRequest;

interface CardInterface
{
    public static function create(CreateBusinessRequest $request):array;
    public static function retrieve(string $token_id):array;
    public static function delete(string $customer_id,string $card_id) :array;

}
