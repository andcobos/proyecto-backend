<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProductCategory>
 */
class ProductCategoryFactory extends Factory
{
    protected $model = ProductCategory::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        $categories = ['Tecnología y Electrónica', 'Moda y Accesorios', 'Hogar y Muebles', 'Alimentos y Bebidas', 'Deportes y Entretenimiento', 'Salud y Belleza', 'Automotriz y Motocicletas', 'Bebés y Niños', 'Oficina y Papelería'];

        return [
            'product_category' => $this->faker->randomElement($categories)
        ];
    }
}
