<?php

namespace App\Packages\TapPayment\Lead;

use App\Packages\TapPayment\Tap;
use App\Packages\TapPayment\Lead\LeadInterface;

class Lead extends Tap implements LeadInterface
{

    public static function connect(array $data) {
        return self::send("/connect/lead/",[],'post');
    }

}