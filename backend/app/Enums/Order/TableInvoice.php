<?php
namespace App\Enums\Order;
use ArchTech\Enums\Values;
enum TableInvoice: string
{
    use Values;
    case PENDING = 'pending';
    case ACCEPTED = 'accepted';
    case REJECTED = 'rejected';
    case PAID = 'PAID';
}
