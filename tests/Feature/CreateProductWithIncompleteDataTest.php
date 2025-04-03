<?php
use Illuminate\Support\Facades\DB;

test('fails to create product with missing fields', function () {
    $this->assertNotNull(DB::connection());

    $payload = [];
    $response = $this->postJson('/v1/products', $payload);
    $response->assertStatus(422)
             ->assertJsonValidationErrors(['product_name', 'price', 'seller_id', 'category_id']);
});
