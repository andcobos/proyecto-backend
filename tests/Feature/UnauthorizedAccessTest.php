<?php

test('unauthenticated users cannot access protected routes', function () {
    $this->getJson('/v1/orders')
         ->assertStatus(401);

    $this->postJson('/v1/products', [])
         ->assertStatus(401);
});
