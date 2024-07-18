<?php

declare(strict_types=1);

namespace App\Actions;

use App\Enums\Currency;
use App\Models\Bill;
use App\Models\ExchangeRate;
use Illuminate\Support\Carbon;
use Illuminate\Support\LazyCollection;

class GetBillsByRangeInCurrency
{
    public function __construct(protected ConvertByRate $convert)
    {
    }

    public function handle(Carbon $from, Carbon $to, Currency $currency)
    {
        $rates = ExchangeRate::query()
            ->select(['date', 'rate'])
            ->whereBetween('date', [$from, $to])
            ->where('currency_key', $currency->value)
            ->get()
            ->keyBy('date');

        return Bill::query()
            ->with('currency')
            ->whereBetween('date', [$from, $to])
            ->lazyById()
            ->chunk(100)
            ->map(function (LazyCollection $bills) use ($rates) {
                return $bills->map(function ($bill) use ($rates) {
                    $rate = $rates->get($bill->date);

                    if ($rate) {
                        $bill->cost = $this->convert->handle($rate, $bill->cost, $bill->currency_key);
                    }

                    return $bill;
                });
            });
    }
}
