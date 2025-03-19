<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Model;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Rol>
 */
class RolFactory extends Factory
{
    protected $model = Rol::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

     
    public function definition(): array
    {
        return [
            'rol' => $this->faker->randomElement(['admin', 'customer', 'seller']),
        ];
    }
}
