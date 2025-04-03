<?php
use Illuminate\Support\Facades\DB;
use App\Models\Product;
use App\Models\Seller;
use App\Models\ProductCategory;

test('creates a product successfully with seller and category using factory', function () {
    $this->assertNotNull(DB::connection());

    $seller = Seller::factory()->create();
    $category = ProductCategory::factory()->create();

    $payload = [
        'product_name' => 'Producto desde Test',
        'description' => 'Creado con seller y category',
        'price' => 19.99,
        'seller_id' => $seller->id,
        'category_id' => $category->id,
    ];

    $response = $this->postJson('/v1/products', $payload);

    $response->assertStatus(201)
             ->assertJsonFragment([
                 'product_name' => 'Producto desde Test',
                 'seller_id' => $seller->id,
                 'category_id' => $category->id,
             ]);

    $this->assertDatabaseHas('products', [
        'product_name' => 'Producto desde Test',
        'seller_id' => $seller->id,
        'category_id' => $category->id,
    ]);
});
