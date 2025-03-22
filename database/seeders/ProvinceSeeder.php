<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Province;

class ProvinceSeeder extends Seeder
{
    public function run()
    {
        $provinces = [
            'Ahuachapán', 'Santa Ana', 'Sonsonate', 'La Libertad', 'Chalatenango',
            'San Salvador', 'Cuscatlán', 'La Paz', 'Cabañas', 'San Vicente',
            'Usulután', 'San Miguel', 'Morazán', 'La Unión'
        ];

        foreach ($provinces as $province) {
            Province::create(['province' => $province]);
        }
    }
}
