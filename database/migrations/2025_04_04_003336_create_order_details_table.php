<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('order_details', function (Blueprint $table) {
            // Composite primary key
            $table->foreignId('order_id')->constrained('orders')->onDelete('cascade'); // Cascade delete if order is deleted
            $table->foreignId('product_id')->constrained('products'); // Don't cascade delete product if order is deleted

            $table->integer('quantity');
            $table->decimal('subtotal', 10, 2); // Price * quantity at time of order

            $table->timestamps();

            // Define composite primary key
            $table->primary(['order_id', 'product_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('order_details');
    }
};