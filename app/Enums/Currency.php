<?php

declare(strict_types=1);

namespace App\Enums;

enum Currency: string
{
    case RUB = 'rub';
    case USD = 'usd';
    case EUR = 'eur';
    case YEAN = 'yean';
}
