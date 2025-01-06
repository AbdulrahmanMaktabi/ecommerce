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
        Schema::create('shipping_rules', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Rule name (e.g., "Free Shipping")
            $table->decimal('price', 8, 2); // Shipping cost
            $table->enum('type', ['flat', 'weight_based', 'free', 'location_based']); // Rule type
            $table->decimal('min_order_value', 8, 2)->nullable(); // Minimum order value
            $table->decimal('max_order_value', 8, 2)->nullable(); // Maximum order value
            $table->decimal('min_weight', 8, 2)->nullable(); // Minimum weight
            $table->decimal('max_weight', 8, 2)->nullable(); // Maximum weight
            $table->string('region')->nullable(); // Region (e.g., "US", "CA")
            $table->boolean('status')->default(true); // Rule status
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shipping_rules');
    }
};
