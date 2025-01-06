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
        Schema::create('coupons', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('code')->unique(); // Coupon code (e.g., DISCOUNT20)
            $table->decimal('discount_amount', 8, 2); // Discount amount or percentage
            $table->enum('discount_type', ['percentage', 'amount']); // Discount type (percentage or fixed amount)
            $table->date('start_date'); // Start date for coupon validity
            $table->date('end_date'); // End date for coupon validity
            $table->integer('usage_limit')->default(1); // Maximum number of uses per coupon
            $table->integer('used_count')->default(0); // Number of times the coupon has been used
            $table->boolean('status')->default(true); // If the coupon is active or not
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('coupons');
    }
};
