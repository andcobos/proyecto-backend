<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            PermissionSeeder::class,
            RolSeeder::class,               
            OrderStatusSeeder::class,       
            PaymentMethodSeeder::class,     
            ProductCategorySeeder::class,   
            StockStatusSeeder::class,       
            SellerStatusSeeder::class,      
            ProvinceSeeder::class,          
            UserSeeder::class,              
            SellerSeeder::class,            
            ProductSeeder::class,           
            OrderSeeder::class,             
            OrderDetailSeeder::class,       
        ]);
    }
}
