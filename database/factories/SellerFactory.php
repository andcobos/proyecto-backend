<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Seller>
 */
class SellerFactory extends Factory
{
    protected $model = Seller::Class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $userId = User::pluck('id')->random()?? User::factory()->create()->id;
        $sellerStatusId = SellerStatus::pluck('id')->random() ?? SellerStatus::factory()->create()->id;

        return [
            'user_id' => $userId,
            'seller_status_id'=> $sellerStatusId,
            'verified' => $this->faker->boolean(),
        ];
    }
}
