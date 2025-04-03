<?php

test('fails to register with invalid data', function () {
    $this->postJson('/v1/user', [
        'name' => 'John',
        'lastname' => 'Doe',
        'email' => 'not-an-email',
        'password' => 'Password123!',
        'password_confirmation' => 'Password123!',
        'address' => '123 Main St',
        'phone_number' => '1234567890',
        'rol_id' => 1
    ])->assertStatus(422)->assertJsonValidationErrors(['email']);

    $this->postJson('/v1/user', [
        'name' => 'John',
        'lastname' => 'Doe',
        'email' => 'john@example.com',
        'password' => '123456',
        'password_confirmation' => '123456',
        'address' => '123 Main St',
        'phone_number' => '1234567890',
        'rol_id' => 1
    ])->assertStatus(422)->assertJsonValidationErrors(['password']);

    $this->postJson('/v1/user', [
        'name' => 'John',
        'lastname' => 'Doe',
        'email' => 'john@example.com',
        'password' => 'Password123!',
        'password_confirmation' => 'DifferentPassword',
        'address' => '123 Main St',
        'phone_number' => '1234567890',
        'rol_id' => 1
    ])->assertStatus(422)->assertJsonValidationErrors(['password']);

    $this->postJson('/v1/user', [
        'name' => 'John'
    ])->assertStatus(422)->assertJsonValidationErrors(['email', 'password']);

});
