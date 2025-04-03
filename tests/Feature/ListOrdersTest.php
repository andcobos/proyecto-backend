<?php
use App\Models\Order;
use App\Models\OrderStatus;
use App\Models\User;
use App\Models\Seller;
use App\Models\PaymentMethod;
use App\Models\Province;
use Illuminate\Support\Facades\DB;

test('lists orders with pagination and filters', function () {
    $this->assertNotNull(DB::connection());

    $user = User::factory()->create();
    $seller = Seller::factory()->create(['user_id' => $user->id]);
    $statusPending = OrderStatus::factory()->create(['status' => 'pending']);
    $statusPaid = OrderStatus::factory()->create(['status' => 'paid']);
    $paymentMethod = PaymentMethod::factory()->create();
    $province = Province::factory()->create();

    Order::factory()->count(3)->create([
        'user_id' => $user->id,
        'seller_id' => $seller->id,
        'order_status_id' => $statusPending->id,
        'payment_method_id' => $paymentMethod->id,
        'province_id' => $province->id,
    ]);

    Order::factory()->count(2)->create([
        'order_status_id' => $statusPaid->id,
        'user_id' => $user->id,
        'seller_id' => $seller->id,
        'payment_method_id' => $paymentMethod->id,
        'province_id' => $province->id,
    ]);

    $this->getJson('/v1/orders')
         ->assertStatus(200)
         ->assertJsonStructure(['data', 'links', 'meta']);

    $this->getJson('/v1/orders?page=1&per_page=2')
         ->assertStatus(200)
         ->assertJsonFragment(['current_page' => 1]);

    $this->getJson("/v1/orders?status_id={$statusPaid->id}")
         ->assertStatus(200)
         ->assertJsonFragment(['order_status_id' => $statusPaid->id]);
});
