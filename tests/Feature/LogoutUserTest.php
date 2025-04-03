<?php

use App\Models\User;
use Laravel\Sanctum\Sanctum;

test('logs out the user successfully', function () {
    $this->assertNotNull(DB::connection());

    $user = User::factory()->create();
    $token = $user->createToken('auth-token')->plainTextToken;

    $response = $this->withHeader('Authorization', 'Bearer ' . $token)
        ->postJson('/v1/auth/logout');

    $response->assertStatus(200)
        ->assertJson([
            'message' => 'Logged out successfully'
        ]);

    // Check that token is no longer valid
    $this->assertCount(0, $user->tokens);
});
