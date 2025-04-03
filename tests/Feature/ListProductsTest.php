<?php
use App\Models\Product;

test('lists products with pagination and filtering', function () {
    Product::factory()->count(5)->create();

    $this->getJson('/v1/products')->assertStatus(200);

    $this->getJson('/v1/products?page=1&per_page=2')->assertStatus(200);

    $product = Product::factory()->create(['product_name' => 'Specific Product Name']);

    $this->getJson('/v1/products?search=Specific')->assertStatus(200)->assertJsonFragment(['product_name' => 'Specific Product Name']);


});
