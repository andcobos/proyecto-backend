<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\SellerStatus;

class SellerStatusSeeder extends Seeder
{
    public function run()
    {
        $statuses = ['active', 'suspended', 'banned', 'pending approval'];

        foreach ($statuses as $status) {
            SellerStatus::create(['seller_status' => $status]);
        }
    }
}
