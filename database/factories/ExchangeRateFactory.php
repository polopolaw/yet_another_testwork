<?php

namespace Database\Factories;

use App\Models\ExchangeRate;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<ExchangeRate>
 */
class ExchangeRateFactory extends Factory
{

    protected int $created = 0;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $this->created++;

        return [
            'rate' => $this->faker->randomFloat(2, 5, 100),
            'date' => $this->faker->date,
            'currency_key' => function ($attributes) {
                $reset = true;
                while ($reset) {
                    $key = $this->faker->randomElement(['USD', 'EUR', 'YEAN']);
                    $count = ExchangeRate::query()
                        ->where('date', $attributes['date'])
                        ->where('currency_key', $key)
                        ->count();
                    $reset = $this->created === 1 && $count !== 0;
                }

                return $key;
            },
        ];
    }
}
