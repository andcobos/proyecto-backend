<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('seller_status', function (Blueprint $table) {
            $table->id();
            $table->string('seller_status')->unique(); // e.g., 'pending', 'approved', 'rejected'
            $table->timestamps(); // Optional
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('seller_status');
    }
};
