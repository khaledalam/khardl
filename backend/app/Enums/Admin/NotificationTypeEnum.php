<?php

namespace App\Enums\Admin;

use ArchTech\Enums\Values;

enum NotificationTypeEnum: string
{
    use Values;
    case OrderCreated = 'order_created';
    case OrderDelivered = 'order_delivered';
}
