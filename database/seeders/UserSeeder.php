<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Rol;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        $roles = Rol::pluck('id')->toArray();

        User::create([
            'rol_id' => $roles[array_rand($roles)],
            'name' => 'Admin User',
            'lastname' => 'System',
            'email' => 'admin@example.com',
            'address' => '123 Admin Street',
            'password' => Hash::make('password'),
            'phone_number' => '123456789',
        ]);
    }
}
