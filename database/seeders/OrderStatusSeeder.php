<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\OrderStatus;

class OrderStatusSeeder extends Seeder
{
    public function run()
    {
        $statuses = ['pending', 'paid', 'canceled', 'refunded'];

        foreach ($statuses as $status) {
            OrderStatus::create(['order_status' => $status]);
        }
    }
}
