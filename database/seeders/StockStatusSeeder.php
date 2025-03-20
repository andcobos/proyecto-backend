<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\StockStatus;

class StockStatusSeeder extends Seeder
{
    public function run()
    {
        $statuses = ['in_stock', 'out_of_stock'];

        foreach ($statuses as $status) {
            StockStatus::create(['stock_status' => $status]);
        }
    }
}
