<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Order;

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
        $orderStatusId = OrderStatus::pluck('id')->random() ?? OrderStatus::factory()->create()->id; 
        $userId = User::pluck('id')->random() ?? User::factory()->create()->id;
        $sellerId = Seller::pluck('id')->random() ?? Seller::factory()->create()->id;
        $paymentMethodId = PaymentMethod::pluck('id')->random() ?? PaymentMethod::factory()->create()->id;
        $provinceId = Province::pluck('id')->random() ?? Province::factory()->create()->id;
        
        return [
            'order_status-id' => $orderStatusId,
            'user_id' =>$userId,
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
