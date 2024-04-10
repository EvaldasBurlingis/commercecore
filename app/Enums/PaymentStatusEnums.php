<?php

namespace App\Enums;

use App\Traits\EnumTrait;

enum PaymentStatusEnums: string
{
    use EnumTrait;

    case PENDING = 'pending';
    case PAID = 'paid';
    case UNPAID = 'unpaid';
    case REFUNDED = 'refunded';
    case PARTIALLY_PAID = 'partially_paid';
    case PAYMENT_FAILED = 'payment_failed';
}
