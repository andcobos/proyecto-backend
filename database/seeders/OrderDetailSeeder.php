<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\OrderDetail;
use App\Models\Order;
use App\Models\Product;

class OrderDetailSeeder extends Seeder
{
    public function run()
    {
        OrderDetail::create([
            'order_id' => Order::pluck('id')->random(),
            'product_id' => Product::pluck('id')->random(),
            'quantity' => 2,
            'subtotal' => 299.99,
        ]);
    }
}
