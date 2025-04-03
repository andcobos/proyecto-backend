<?php

use App\Models\User;


test('fails to log in with incorrect credentials', function () {
    $this->assertNotNull(DB::connection());

    $user = User::factory()->create([
        'email' => 'test@example.com',
        'password' => bcrypt('Password123!')
    ]);

    //Contrasena incorrecta
    $response1 = $this->postJson('/v1/login', [
        'email' => 'test@example.com',
        'password' => 'WrongPassword'
    ]);

    $response1->assertStatus(401)->assertJson([
        'message' => 'Las credenciales proporcionada son incorrectas'
    ]);

    //Correo no registrado
    $response2 = $this->postJson('/v1/login', [
        'email' => 'nonexistent@example.com',
        'password' => 'Password123!'
    ]);


    $response2->assertStatus(401)->assertJson([
        'message' => 'Las credenciales proporcionadas son incorrectas.'
    ]);
});
