<?php

use App\Models\User;
use Laravel\Sanctum\Sanctum;

test('updates user info successfully', function () {

    $this->assertNotNull(DB::connection());

    $user = User::factory()->create();
    Sanctum::actingAs($user);

    $data = [
        'name' => 'Updated',
        'lastname' => 'Name',
        'email' => 'updated@example.com'
    ];

    $this->patchJson("/v1/users/{$user->id}", $data)
        ->assertStatus(200);


    $this->assertDatabaseHas('users', [
        'id' => $user->id,
        'name' => 'Updated',
        'lastname' => 'Name',
        'email' => 'updated@example.com'
    ]);
});
