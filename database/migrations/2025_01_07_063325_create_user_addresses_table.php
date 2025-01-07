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
        Schema::create('user_addresses', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Name field (required)
            $table->string('email'); // Email field (required, email format)
            $table->string('phone'); // Phone field (required, numeric)
            $table->string('country'); // Country field (required)
            $table->string('city'); // City field (required)
            $table->string('zipcode'); // Zipcode field (required, numeric)
            $table->enum('address_type', ['home', 'work', 'other']); // Address type (required, predefined types)
            $table->text('type_comment'); // Type comment field (required)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_addresses');
    }
};
