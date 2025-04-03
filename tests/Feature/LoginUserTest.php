<?php
use App\Models\User;

test('logs in a user successfully', function () {

    $this->assertNotNull(DB::connection());

    $user = User::factory()->create([
        'email' => 'test@example.com',
        'password' => bcrypt('Password123!')
    ]);

    $response = $this->postJson('/api/login', [
        'email' => 'test@example.com',
        'password' => 'Password123!'
    ]);

    $response->assertStatus(200)
        ->assertJsonStructure([
            'user' => ['id', 'name', 'lastname', 'email'],
            'token'
        ]);
});
