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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug');
            $table->string('thumb_image');

            $table->unsignedBigInteger('vendor_id');
            $table->foreign('vendor_id')->references('id')->on('vendors')->onDelete('cascade');

            $table->unsignedBigInteger('brand_id');
            $table->foreign('brand_id')->references('id')->on('brands')->onDelete('cascade');

            $table->unsignedBigInteger('category_id');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');

            $table->unsignedBigInteger('subCategory_id');
            $table->foreign('subCategory_id')->references('id')->on('sub_categories')->onDelete('cascade');

            $table->unsignedBigInteger('childCategory_id');
            $table->foreign('childCategory_id')->references('id')->on('child_categories')->onDelete('cascade');

            $table->integer('qty');

            $table->string('short_description');
            $table->text('long_description');

            $table->string('video_link')->nullable();

            $table->string('sku')->nullable();

            $table->double('price');
            $table->double('offer_price')->nullable();
            $table->date('offer_start_date')->nullable();
            $table->date('offer_end_date')->nullable();

            $table->boolean('is_top')->nullable();
            $table->boolean('is_best')->nullable();
            $table->boolean('is_featured')->nullable();
            $table->boolean('status');
            $table->boolean('is_approved')->default(false);

            $table->string('seo_title')->nullable();
            $table->text('seo_description')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
