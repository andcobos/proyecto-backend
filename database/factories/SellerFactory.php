<?php

namespace Database\Factories;

use App\Models\Seller;
use App\Models\SellerStatus;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Seller>
 */
class SellerFactory extends Factory
{
    protected $model = Seller::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Using query()->inRandomOrder()->first() instead of pluck()->random()
        $userId = User::query()->inRandomOrder()->first()?->id ?? User::factory()->create()->id;
        $sellerStatusId = SellerStatus::query()->inRandomOrder()->first()?->id ?? SellerStatus::factory()->create()->id;

        return [
            'user_id' => $userId,
            'seller_status_id'=> $sellerStatusId,
            'verified' => $this->faker->boolean(),
        ];
    }
}
