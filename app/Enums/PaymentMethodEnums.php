<?php

namespace App\Enums;
use App\Traits\EnumTrait;

enum PaymentMethodEnums: string
{
    use EnumTrait;

    case CREDIT_CARD = 'credit_card';
    case DEBIT_CARD = 'debit_card';
    case PAYPAL = 'paypal';
    case BANK_TRANSFER = 'bank_transfer';
    case CASH_ON_DELIVERY = 'cash_on_delivery';
}
