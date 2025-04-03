<?php
use App\Models\Product;
use Illuminate\Support\Facades\DB;

test('returns 404 when getting a nonexistent product', function () {
    $this->assertNotNull(DB::connection());

    $existingProduct = Product::factory()->create();
    $nonExistentId = $existingProduct->id + 9999;

    $this->getJson("/v1/products/{$nonExistentId}")
        ->assertStatus(404);
});
