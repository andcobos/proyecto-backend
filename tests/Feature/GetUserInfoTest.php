<?php
use App\Models\User;
use Laravel\Sanctum\Sanctum;

test('retrieves authenticated user info', function () {
    $this->assertNotNull(DB::connection());

    $user = User::factory()->create();
    Sanctum::actingAs($user);

    $this->getJson('/users')
        ->assertStatus(200);
});
