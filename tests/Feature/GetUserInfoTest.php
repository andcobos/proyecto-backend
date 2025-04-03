<?php
use App\Models\User;
use Laravel\Sanctum\Sanctum;

test('retrieves authenticated user info', function () {
    $this->assertNotNull(DB::connection());

    $user = User::factory()->create();
    $response = $this->actingAs($user)->getJson('/users');

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
});
