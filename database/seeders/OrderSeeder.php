<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Order;
use App\Models\OrderStatus;
use App\Models\User;
use App\Models\Seller;
use App\Models\PaymentMethod;
use App\Models\Province;

class OrderSeeder extends Seeder
{
    public function run()
    {
        Order::create([
            'order_status_id' => OrderStatus::pluck('id')->random(),
            'user_id' => User::pluck('id')->random(),
            'seller_id' => Seller::pluck('id')->random(),
            'payment_method_id' => PaymentMethod::pluck('id')->random(),
            'province_id' => Province::pluck('id')->random(),
            'total' => 150.50,
            'order_date' => now(),
        ]);
    }
}
