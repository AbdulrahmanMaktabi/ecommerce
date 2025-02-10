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
        Schema::create('paypal_settings', function (Blueprint $table) {
            $table->id();
            $table->boolean('status')->default(1); // Enable (1) or Disable (0)
            $table->boolean('layout')->default(0); // Sandbox (0) or Live (1)
            $table->string('country');             // Country name
            $table->string('currency_name');       // Currency name
            $table->decimal('currency_rate', 10, 4)->default(1.0000); // Currency rate in USD
            $table->string('user_id');             // PayPal User ID
            $table->string('secret_key');          // PayPal Secret Key
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('paypal_settings');
    }
};
