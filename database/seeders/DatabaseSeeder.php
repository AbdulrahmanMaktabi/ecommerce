<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
        // \App\Models\Category::factory(10)->create();
        // \App\Models\SubCategory::factory(30)->create();
        // \App\Models\ChildCategory::factory(50)->create();
        // \App\Models\Brand::factory(15)->create();
        // \App\Models\Product::factory(100)->create();
        // \App\Models\User::factory(20)->create();
        \App\Models\Vendor::factory(10)->create();
        // \App\Models\ProductVariant::factory(50)->create();
        // \App\Models\ProductVariantIem::factory(100)->create();
        // \App\Models\ProductImageGallery::factory(100)->create();
    }
}
