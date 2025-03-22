<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Seller;
use App\Models\User;
use App\Models\SellerStatus;

class SellerSeeder extends Seeder
{
    public function run()
    {
        $users = User::pluck('id')->toArray();
        $statuses = SellerStatus::pluck('id')->toArray();

        foreach ($users as $userId) {
            Seller::create([
                'user_id' => $userId,
                'seller_status_id' => $statuses[array_rand($statuses)],
                'verified' => true,
            ]);
        }
    }
}
