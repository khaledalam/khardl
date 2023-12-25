<?php

namespace App\Packages\TapPayment\Card;

use App\Packages\TapPayment\Requests\CreateBusinessRequest;

interface CardInterface
{
    public static function create(CreateBusinessRequest $request):array;

}
