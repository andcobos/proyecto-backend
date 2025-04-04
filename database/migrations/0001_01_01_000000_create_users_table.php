<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('lastname'); // Assuming you have this
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('address')->nullable(); // From AuthController
            $table->string('phone_number')->nullable(); // From AuthController

            // Add rol_id and foreign key HERE
            $table->unsignedBigInteger('rol_id'); // Or just foreignId
            // $table->foreignId('rol_id')->constrained('rols'); // Simpler Laravel 8+ way

            $table->rememberToken();
            $table->timestamps();

            // Define the foreign key constraint
            $table->foreign('rol_id')->references('id')->on('rols')->onDelete('cascade'); // Or restrict, set null etc.
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
