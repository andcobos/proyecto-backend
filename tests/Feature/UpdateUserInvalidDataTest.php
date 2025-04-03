<?php
use App\Models\User;
use Laravel\Sanctum\Sanctum;

test('fails to update user with invalid data', function () {
    $this->assertNotNull(DB::connection());

    $user = User::factory()->create();
    $anotherUser = User::factory()->create();

    $this->actingAs($user);

    $this->patchJson("/v1/users/{$user->id}",[
        'name'=> 'Updated',
        'email' => 'not-an-email'
    ])->assertStatus(422)->assertJsonValidationErrors(['email']);

    $this->patchJson("/v1/users/{$user->id}", [
        'name' => 'Updated',
        'email' => $anotherUser->email
    ])->assertStatus(422)->assertJsonValidationErrors(['email']);

    $this->patchJson("/v1/users/{$user->id}", [
        'name' => 'A',
        'email' => 'valid@example.com'
    ])->assertStatus(422)->assertJsonValidationErrors(['name']);

});
