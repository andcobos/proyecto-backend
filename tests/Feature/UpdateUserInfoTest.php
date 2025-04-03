<?php

use App\Models\User;

test('updates user info successfully', function () {

    $this->assertNotNull(DB::connection());

    $user = User::factory()->create();


    $data = [
        'name' => 'Updated',
        'lastname' => 'Name',
        'email' => 'updated@example.com'
    ];

    $response = $this->actingAs($user)->patchJson("/v1/users/{$user->id}", $data);

    $response->assertStatus(200)
        ->assertJsonStructure([
            'id',
            'name',
            'lastname',
            'email',
            'address',
            'phone_number',
            'created_at',
            'updated_at'
        ]);


    $this->assertDatabaseHas('users', [
        'id' => $user->id,
        'name' => 'Updated',
        'lastname' => 'Name',
        'email' => 'updated@example.com'
    ]);
});
