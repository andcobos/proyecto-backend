<?php
use App\Models\User;
use App\Models\Seller;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\OrderStatus;
use App\Models\PaymentMethod;
use App\Models\Province;
use Illuminate\Support\Facades\DB;

test('view order details with products', function () {
    $this->assertNotNull(DB::connection());

    $user = User::factory()->create();
    $seller = Seller::factory()->create(['user_id' => $user->id]);
    $orderStatus = OrderStatus::factory()->create();
    $paymentMethod = PaymentMethod::factory()->create();
    $province = Province::factory()->create();

    $products = Product::factory()->count(2)->create([
        'seller_id' => $seller->id,
        'stock' => 10,
        'price' => 25.00,
    ]);

    $order = Order::factory()->create([
        'user_id' => $user->id,
        'seller_id' => $seller->id,
        'order_status_id' => $orderStatus->id,
        'payment_method_id' => $paymentMethod->id,
        'province_id' => $province->id,
        'order_date' => now(),
        'total' => $products->sum(fn($p) => $p->price * 2),
    ]);

    foreach ($products as $product) {
        OrderDetail::create([
            'order_id' => $order->id,
            'product_id' => $product->id,
            'quantity' => 2,
            'subtotal' => $product->price * 2,
        ]);
    }

    $response = $this->getJson("/v1/orders/{$order->id}");

    $response->assertStatus(200)
             ->assertJsonFragment([
                 'id' => $order->id,
                 'user_id' => $user->id,
                 'seller_id' => $seller->id,
                 'total' => $order->total,
             ]);

    foreach ($products as $product) {
        $response->assertJsonFragment([
            'product_id' => $product->id,
            'quantity' => 2,
            'subtotal' => $product->price * 2,
        ]);
    }
});
