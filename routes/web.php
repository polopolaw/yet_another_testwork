<?php

use App\Actions\GetBillsByRangeInCurrency;
use App\Enums\Currency;
use App\Exceptions\ExchangeRateNotFound;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $chunks = app(GetBillsByRangeInCurrency::class)
        ->handle(now()->subYear(), now(), Currency::EUR);
    try {
        foreach ($chunks as $chunk) {
            foreach ($chunk as $item) {
                dump($item);
            }
        }
    } catch (ExchangeRateNotFound $e) {
        logger()
            ->error($e);
    }
    return view('welcome');
});
