<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    protected $model = ProductFactory::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $stockStatusId = StockStatus::pluck('id')->random() ?? StockStatus::factory()->create()->id;
        $sellerId = Seller::pluck('id')->random() ?? Seller::factory()->create()->id;
        $categoryId = ProductCategory::pluck('id')->random() ?? ProductCategory::factory()->create()->id;

        return [
            'product_name' => $this->faker->words(3, true),
            'sku' => $this->faker->unique()->ean8(),
            'price' => $this->faker->randomFloat(2, 10, 1000),
            'stock' => $this->faker->numberBetween(0, 100),
            'stock_status_id' => $stockStatusId,
            'seller_id' => $sellerId,
            'category_id' => $categoryId,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
