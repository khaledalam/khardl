<?php

namespace App\Enums\Customer;

use ArchTech\Enums\Values;

enum AddressesTypeEnum: string
{
    use Values;
    case HOME = 'home';
    case OFFICE = 'office';
    case OTHER = 'other';
}
