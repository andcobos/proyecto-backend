<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Rol;

class RolSeeder extends Seeder
{
    public function run()
    {
        $roles = ['admin', 'customer', 'seller'];

        foreach ($roles as $rol) {
            Rol::create(['rol' => $rol]);
        }
    }
}
