<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('rols', function (Blueprint $table) {
            $table->id();
            // Assuming 'admin', 'seller', 'customer' are the roles based on previous code
            $table->enum('rol', ['admin', 'seller', 'customer'])->unique();
            $table->timestamps(); // Optional for roles, but good practice
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('rols');
    }
};