<?php

namespace Database\Seeders;

use App\Models\Bill;
use App\Models\Currency;
use App\Models\ExchangeRate;
use App\Models\User;
use Carbon\CarbonPeriodImmutable;
use Illuminate\Database\Seeder;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Currency::factory(4)->create();

        foreach (CarbonPeriodImmutable::create(
            now()->subYears(2),
            '1 day',
            now()
        ) as $date) {

            foreach (\App\Enums\Currency::cases() as $currency) {
                if ($currency === \App\Enums\Currency::RUB) {
                    continue;
                }
                ExchangeRate::factory()->create([
                    'date' => $date->format('Y-m-d'),
                    'currency_key' => $currency,
                ]);
            }
        }

        Bill::factory(20000)->create();
    }
}
