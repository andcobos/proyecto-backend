<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ProductCategory;

class ProductCategorySeeder extends Seeder
{
    public function run()
    {
        $categories = [
            'Tecnología y Electrónica', 'Moda y Accesorios', 'Hogar y Muebles',
            'Alimentos y Bebidas', 'Deportes y Entretenimiento', 'Salud y Belleza',
            'Automotriz y Motocicletas', 'Bebés y Niños', 'Oficina y Papelería'
        ];

        foreach ($categories as $category) {
            ProductCategory::create(['product_category' => $category]);
        }
    }
}
