<?php
use App\Models\User;
use App\Models\Seller;
use App\Models\Product;
use App\Models\OrderStatus;
use App\Models\PaymentMethod;
use App\Models\Province;
use Illuminate\Support\Facades\DB;

test('creates an order successfully with products and user', function () {
    $this->assertNotNull(DB::connection());

    $user = User::factory()->create();
    $seller = Seller::factory()->create(['user_id' => $user->id]);
    $orderStatus = OrderStatus::factory()->create();
    $paymentMethod = PaymentMethod::factory()->create();
    $province = Province::factory()->create();
    $products = Product::factory()->count(2)->create(['seller_id' => $seller->id]);

    $orderDetails = $products->map(function ($product) {
        return [
            'product_id' => $product->id,
            'quantity' => 2,
            'subtotal' => $product->price * 2,
        ];
    })->toArray();

    $total = collect($orderDetails)->sum('subtotal');

    $payload = [
        'order_status_id' => $orderStatus->id,
        'user_id' => $user->id,
        'seller_id' => $seller->id,
        'payment_method_id' => $paymentMethod->id,
        'province_id' => $province->id,
        'order_date' => now()->toDateTimeString(),
        'total' => $total,
        'products' => $orderDetails,
    ];

    $response = $this->postJson('/v1/orders', $payload);

    $response->assertStatus(201)
             ->assertJsonFragment([
                 'user_id' => $user->id,
                 'seller_id' => $seller->id,
                 'total' => $total,
             ]);

    $this->assertDatabaseHas('orders', [
        'user_id' => $user->id,
        'seller_id' => $seller->id,
        'total' => $total,
    ]);

    foreach ($orderDetails as $detail) {
        $this->assertDatabaseHas('orders_details', [
            'product_id' => $detail['product_id'],
            'quantity' => $detail['quantity'],
            'subtotal' => $detail['subtotal'],
        ]);
    }
});
