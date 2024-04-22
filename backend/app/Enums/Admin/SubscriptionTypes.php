<?php

namespace App\Enums\Admin;

use ArchTech\Enums\Values;

enum SubscriptionTypes: string
{
    use Values;
    case WEB = 'web';
    case APP = 'app';
}
