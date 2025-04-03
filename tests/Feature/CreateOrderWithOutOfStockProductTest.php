<?php
use App\Models\User;
use App\Models\Seller;
use App\Models\Product;
use App\Models\OrderStatus;
use App\Models\PaymentMethod;
use App\Models\Province;
use Illuminate\Support\Facades\DB;

test('fails to create an order with product that has no stock', function () {
    $this->assertNotNull(DB::connection());

    $user = User::factory()->create();
    $seller = Seller::factory()->create(['user_id' => $user->id]);
    $orderStatus = OrderStatus::factory()->create();
    $paymentMethod = PaymentMethod::factory()->create();
    $province = Province::factory()->create();

    $product = Product::factory()->create([
        'seller_id' => $seller->id,
        'stock' => 0,
        'price' => 99.99,
    ]);

    $orderDetails = [
        [
            'product_id' => $product->id,
            'quantity' => 1,
            'subtotal' => $product->price,
        ]
    ];

    $payload = [
        'order_status_id' => $orderStatus->id,
        'user_id' => $user->id,
        'seller_id' => $seller->id,
        'payment_method_id' => $paymentMethod->id,
        'province_id' => $province->id,
        'order_date' => now()->toDateTimeString(),
        'total' => $product->price,
        'products' => $orderDetails,
    ];

    $response = $this->postJson('/v1/orders', $payload);

    $response->assertStatus(422)
             ->assertJsonFragment([
                 'message' => 'One or more products are out of stock.'
             ]);

    $this->assertDatabaseMissing('orders', [
        'user_id' => $user->id,
        'total' => $product->price,
    ]);
});
