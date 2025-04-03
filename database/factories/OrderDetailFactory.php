<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\OrderDetail>
 */
class OrderDetailFactory extends Factory
{
    protected $model = OrderDetail::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $orderId = Order::query()->inRandomOrder()->first()?->id ?? Order::factory()->create()->id;
        $productId = Product::query()->inRandomOrder()->first()?->id ?? Product::factory()->create()->id;

        $product = Product::find($productId);
        $quantity = $this->faker->numberBetween(1, 5);
        $price = $product ? $product->price : $this->faker->randomFloat(2, 10, 500);
        $subtotal = $price * $quantity;

        return [
            'order_id' => $orderId,
            'product_id' => $productId,
            'quantity' => $quantity,
            'subtotal' => $subtotal,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
