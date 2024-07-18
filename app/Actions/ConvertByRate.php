<?php

declare(strict_types=1);

namespace App\Actions;

use App\Enums\Currency;
use App\Models\ExchangeRate;

class ConvertByRate
{
    public function handle(ExchangeRate $rate, float|int $amount, Currency $from): float|int
    {
        if ($rate->currency_key === $from) {
            return $amount;
        }
        return $amount * $rate->rate;
    }
}
