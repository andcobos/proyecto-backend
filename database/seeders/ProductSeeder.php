<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\StockStatus;
use App\Models\Seller;
use App\Models\ProductCategory;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        if (
            StockStatus::count() === 0 ||
            Seller::count() === 0 ||
            ProductCategory::count() === 0
        ) {
            $this->command->warn('StockStatus, Seller o ProductCategory vacíos. Creando datos de referencia...');

            StockStatus::factory()->count(2)->create();
            Seller::factory()->count(2)->create();
            ProductCategory::factory()->count(2)->create();
        }

        Product::factory()->count(10)->create();
    }
}
