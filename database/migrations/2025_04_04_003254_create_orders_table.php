<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_status_id')->constrained('order_status');
            $table->foreignId('user_id')->constrained('users'); // The customer
            $table->foreignId('seller_id')->constrained('sellers'); // The seller fulfilling
            $table->foreignId('payment_method_id')->constrained('payment_methods');
            $table->foreignId('province_id')->constrained('provinces'); // Shipping province?
            $table->timestamp('order_date')->useCurrent();
            $table->decimal('total', 10, 2); // Example: 10 total digits, 2 after decimal
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};