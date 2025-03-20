<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\PaymentMethod;

class PaymentMethodSeeder extends Seeder
{
    public function run()
    {
        $methods = ['credit_card', 'debit_card', 'bank_transfer', 'cash'];

        foreach ($methods as $method) {
            PaymentMethod::create(['payment_method' => $method]);
        }
    }
}
