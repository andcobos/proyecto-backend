<?php
use App\Models\User;

test('registers a user successfully', function () {
    $this->assertNotNull(DB::connection());
    $userData = [
        'name' => 'John',
        'lastname' => 'Doe',
        'email' => 'john@example.com',
        'password' => 'Password123!',
        'password_confirmation' => 'Password123!',
        'address' => '123 Main St',
        'phone_number' => '1234567890',
        'rol_id' => 1
    ];
    $response = $this->postJson('/v1/user', $userData);

    $response->assertStatus(201)->assertJsonStructure([
        'id',
        'name',
        'email',
        'address',
        'phone_number',
        'rol_id',
        'created_at',
        'updated_at'
    ]);

    $this->assertDatabaseHas('users', [
        'email' => 'john@example.com',
        'lastname' => 'Doe'
    ]);
});
