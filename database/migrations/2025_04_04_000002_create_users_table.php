<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->foreignId('rol_id')->constrained('rols'); // Foreign key to rols table
            $table->string('name');
            $table->string('lastname'); // Added lastname
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable(); // Keep this standard field
            $table->string('password');
            $table->string('address')->nullable(); // Added address
            $table->string('phone_number')->nullable(); // Added phone_number
            $table->rememberToken(); // Keep this standard field
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};