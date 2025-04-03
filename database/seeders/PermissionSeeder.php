<?php

namespace Database\Seeders;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        // Crear roles
        $admin = Role::firstOrCreate(['name' => 'admin', 'guard_name' => 'api']);
        $seller = Role::firstOrCreate(['name' => 'seller', 'guard_name' => 'api']);
        $client = Role::firstOrCreate(['name' => 'client', 'guard_name' => 'api']);

        // Permisos para usuarios
        $userPermissions = [
            'create-user',
            'read-user',
            'update-user',
            'delete-user',
            'list-users',
        ];

        // Permisos para productos
        $productPermissions = [
            'create-product',
            'read-product',
            'update-product',
            'delete-product',
            'list-products',
        ];

        // Permisos para ordenes
        $orderPermissions = [
            'create-order',
            'read-order',
            'delete-order',
            'list-orders',
            'update-order-status',
        ];

        //Permisos para vendedores
        $sellerPermissions = [
            'create-seller',
            'read-seller',
            'update-seller',
            'delete-seller',
            'list-sellers',
            'update-seller-status',
        ];

        $allPermissions = array_merge(
            $userPermissions,
            $productPermissions,
            $orderPermissions,
            $sellerPermissions
        );

        foreach ($allPermissions as $permission) {
            Permission::firstOrCreate(['name' => $permission, 'guard_name' => 'api']);
        }

        // Asignar todos los permisos al admin
        $admin->givePermissionTo($allPermissions);

        // Asignar permisos especificos para el vendedor
        $seller->givePermissionTo([
            'read-product',
            'list-products',
            'create-product',
            'update-product',
            'delete-product',
            'read-order',
            'list-orders',
            'create-seller',
            'read-user',
            'update-user',
        ]);

        // Permisos del cliente
        $client->givePermissionTo([
            'read-product',
            'list-products',
            'create-order',
            'read-order',
            'list-orders',
            'read-user',
            'update-user',
        ]);

        // Crear usuarios de prueba
        $adminUser = User::firstOrCreate(
            ['email' => 'admin@marketplace.com'],
            [
                'name' => 'Admin',
                'lastname' => 'User',
                'password' => bcrypt('password'),
                'address' => 'Admin Address',
                'phone_number' => '1234567890',
                'rol_id' => 1,
            ]
        );

        $sellerUser = User::firstOrCreate(
            ['email' => 'seller@marketplace.com'],
            [
                'name' => 'Seller',
                'lastname' => 'User',
                'password' => bcrypt('password'),
                'address' => 'Seller Address',
                'phone_number' => '0987654321',
                'rol_id' => 2,
            ]
        );

        $clientUser = User::firstOrCreate(
            ['email' => 'client@marketplace.com'],
            [
                'name' => 'Client',
                'lastname' => 'User',
                'password' => bcrypt('password'),
                'address' => 'Client Address',
                'phone_number' => '1122334455',
                'rol_id' => 3,
            ]
        );

        $adminUser->assignRole($admin);
        $sellerUser->assignRole($seller);
        $clientUser->assignRole($client);

    }
}
