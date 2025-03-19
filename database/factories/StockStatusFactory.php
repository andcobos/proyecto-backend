<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class StockStatusFactory extends Factory
{
    protected $model = StockStatus::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'stock_status' => $this->faker->randomElement(['in_stock', 'out_of_stock']),

        ];
    }
}
