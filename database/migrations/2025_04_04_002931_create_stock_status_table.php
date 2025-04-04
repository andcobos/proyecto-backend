<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('stock_status', function (Blueprint $table) {
            $table->id();
            $table->string('stock_status')->unique(); // e.g., 'in_stock', 'out_of_stock', 'low_stock'
            $table->timestamps(); // Optional
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('stock_status');
    }
};
