<?php

namespace App\Enums;

use App\Traits\EnumTrait;

enum OrderStatusEnums: string
{
    use EnumTrait;

    case PENDING = 'pending';
    case PROCESSING = 'processing';
    case SHIPPED = 'shipped';
    case DELIVERED = 'delivered';
    case CANCELLED = 'cancelled';
}
