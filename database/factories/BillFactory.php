<?php

namespace Database\Factories;

use App\Models\Bill;
use App\Models\Currency;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Bill>
 */
class BillFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'cost' => $this->faker->randomFloat(2, 0, 5000),
            'date' => $this->faker->date,
            'currency_key' => Currency::query()->inRandomOrder()->value('key'),
        ];
    }
}
