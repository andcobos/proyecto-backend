<?php

namespace Database\Factories;

use App\Models\SellerStatus;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SellerStatus>
 */
class SellerStatusFactory extends Factory
{
    protected $model = SellerStatus::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'status' => $this->faker->randomElement(['active', 'suspended', 'banned', 'pending approval']),
        ];
    }
}
