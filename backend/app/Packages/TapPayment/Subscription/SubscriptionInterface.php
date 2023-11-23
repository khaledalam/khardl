<?php

namespace App\Packages\TapPayment\Subscription;

use App\Packages\TapPayment\Requests\CreateSubscriptionRequest;

interface SubscriptionInterface
{
    public static function create(CreateSubscriptionRequest $request):array;
    public static function retrieve(string $business_id):array;
}
