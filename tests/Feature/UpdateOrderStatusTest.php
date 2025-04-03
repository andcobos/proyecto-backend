<?php
use App\Models\Order;
use App\Models\OrderStatus;
use Illuminate\Support\Facades\DB;

test('updates order status successfully with valid status', function () {
    $this->assertNotNull(DB::connection());

    $initialStatus = OrderStatus::factory()->create(['status' => 'pending']);
    $newStatus = OrderStatus::factory()->create(['status' => 'paid']);

    $order = Order::factory()->create([
        'order_status_id' => $initialStatus->id,
    ]);

    $payload = [
        'order_status_id' => $newStatus->id
    ];

    //PUT
    $response = $this->putJson("/v1/orders/{$order->id}", $payload);

    $response->assertStatus(200)
             ->assertJsonFragment([
                 'id' => $order->id,
                 'order_status_id' => $newStatus->id,
             ]);

    $this->assertDatabaseHas('orders', [
        'id' => $order->id,
        'order_status_id' => $newStatus->id,
    ]);
});
