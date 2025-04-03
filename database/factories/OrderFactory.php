<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\OrderStatus;
use App\Models\PaymentMethod;
use App\Models\Province;
use App\Models\Seller;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    protected $model = Order::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $orderStatusId = OrderStatus::query()->inRandomOrder()->first()?->id ?? OrderStatus::factory()->create()->id;
        $userId = User::query()->inRandomOrder()->first()?->id ?? User::factory()->create()->id;
        $sellerId = Seller::query()->inRandomOrder()->first()?->id ?? Seller::factory()->create()->id;
        $paymentMethodId = PaymentMethod::query()->inRandomOrder()->first()?->id ?? PaymentMethod::factory()->create()->id;
        $provinceId = Province::query()->inRandomOrder()->first()?->id ?? Province::factory()->create()->id;

        return [
            'order_status_id' => $orderStatusId,
            'user_id' => $userId,
            'seller_id' => $sellerId,
            'order_date' => $this->faker->dateTimeBetween('-6 months', 'now'),
            'total' => $this->faker->randomFloat(2, 20, 2000),
            'payment_method_id' => $paymentMethodId,
            'province_id' => $provinceId,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
