<?php

namespace App\Traits;

trait EnumTrait
{
    public static function toArray(): array
    {
        return array_column(self::cases(), 'value');
    }
}
