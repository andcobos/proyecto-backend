<?php
use App\Models\Product;
use App\Models\Seller;
use App\Models\ProductCategory;
use Illuminate\Support\Facades\DB;

test('updates a product successfully with valid data', function () {
    $this->assertNotNull(DB::connection());

    $seller = Seller::factory()->create();
    $category = ProductCategory::factory()->create();

    $product = Product::factory()->create([
        'product_name' => 'Producto',
        'description' => 'Descripción',
        'price' => 50.00,
        'seller_id' => $seller->id,
        'category_id' => $category->id,
    ]);

    $updatePayload = [
        'product_name' => 'Producto Actualizado',
        'description' => 'Nueva descripción',
        'price' => 75.99,
        'seller_id' => $seller->id,
        'category_id' => $category->id,
    ];

    $response = $this->putJson("/v1/products/{$product->id}", $updatePayload);

    $response->assertStatus(200)
             ->assertJsonFragment([
                 'product_name' => 'Producto Actualizado',
                 'description' => 'Nueva descripción',
                 'price' => 75.99,
             ]);

    $this->assertDatabaseHas('products', [
        'id' => $product->id,
        'product_name' => 'Producto Actualizado',
        'description' => 'Nueva descripción',
        'price' => 75.99,
    ]);
});
