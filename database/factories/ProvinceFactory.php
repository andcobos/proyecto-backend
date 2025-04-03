<?php

namespace Database\Factories;

use App\Models\Province;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Province>
 */
class ProvinceFactory extends Factory
{
    protected $model = Province::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $departamentos = [
            'Ahuachapán',
            'Santa Ana',
            'Sonsonate',
            'La Libertad',
            'Chalatenango',
            'San Salvador',
            'Cuscatlán',
            'La Paz',
            'Cabañas',
            'San Vicente',
            'Usulután',
            'San Miguel',
            'Morazán',
            'La Unión'
        ];

        return [
            'province' => $this->faker->randomElement($departamentos),
        ];
    }
}
