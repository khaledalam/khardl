<?php

namespace App\Enums\Admin;

use ArchTech\Enums\Values;

enum CouponTypes: string
{
    use Values;
    case FIXED_COUPON = 'fixed';
    case PERCENTAGE_COUPON = 'percentage';
}
