<?php

namespace App\Enums\Admin;

use ArchTech\Enums\Values;

enum AdsRequestsStatusEnum: string
{
    use Values;
    case PENDING = 'pending';
    case CONTACTED = 'contacted';
    case COMPLETED = 'completed';
    case CANCELLED = 'cancelled';
}
