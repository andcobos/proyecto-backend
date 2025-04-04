<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('seller_id')->constrained('sellers'); // FK to sellers
            $table->foreignId('category_id')->constrained('product_categories'); // FK to product_categories
            $table->foreignId('stock_status_id')->constrained('stock_status'); // FK to stock_status
            $table->string('product_name');
            $table->string('sku')->unique()->nullable(); // Stock Keeping Unit
            $table->decimal('price', 8, 2); // Example: 8 total digits, 2 after decimal
            $table->integer('stock')->default(0);
            // Add other product fields if needed (description, images, etc.)
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};