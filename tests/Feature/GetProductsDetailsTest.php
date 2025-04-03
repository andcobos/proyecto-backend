<?php

use App\Models\Product;

test('gets products details', function () {
    $this->assertNotNull(DB::connection());
    
    $product = Product::factory()->create([
        'product_name' => 'Test Product',
        'description' => 'Test Description',
        'price' => 99.99
    ]);

    $this->getJson("/v1/products/{$product->id}")->assertStatus(200) -> assertJson([
        'id' => $product->id,
        'product_name' => 'Test Product',
        'description' => 'Test Description',
        'price' => 99.99
    ]);

    $this->getJson("/v1/products/" . ($product->id + 9999))->assertStatus(404);
});
