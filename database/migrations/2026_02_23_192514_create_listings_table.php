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
        Schema::create('listings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('title');
            $table->text('description');
            $table->decimal('price', 10, 2);
            $table->string('category'); // e.g., Electronics, Clothing, Furniture
            $table->string('condition'); // New, Like New, Used
            $table->string('neighborhood'); // e.g., Kezira, Megala, Taiwan, Sabiyan
            $table->string('phone_number');
            $table->json('images')->nullable(); // To store multiple image paths
            $table->boolean('is_sold')->default(false);
            $table->timestamps();
            });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('listings');
    }
};
