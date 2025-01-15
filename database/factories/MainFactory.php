<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CategoryFactory extends Factory
{
    public function definition()
    {
        return [
            'name' => $this->faker->word,
            'slug' => Str::slug($this->faker->unique()->word),
            'icon' => $this->faker->imageUrl(64, 64, 'business'),
            'status' => $this->faker->boolean,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}

class SubCategoryFactory extends Factory
{
    public function definition()
    {
        return [
            'name' => $this->faker->word,
            'category_id' => \App\Models\Category::factory(),
            'slug' => Str::slug($this->faker->unique()->word),
            'status' => $this->faker->boolean,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}

class ChildCategoryFactory extends Factory
{
    public function definition()
    {
        return [
            'name' => $this->faker->word,
            'sub_category_id' => \App\Models\SubCategory::factory(),
            'category_id' => \App\Models\Category::factory(),
            'slug' => Str::slug($this->faker->unique()->word),
            'status' => $this->faker->boolean,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}

class BrandFactory extends Factory
{
    public function definition()
    {
        return [
            'name' => $this->faker->word,
            'image' => $this->faker->imageUrl(100, 100, 'brand'),
            'status' => $this->faker->boolean,
            'featured' => $this->faker->boolean,
            'slug' => Str::slug($this->faker->unique()->word),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}

class ProductFactory extends Factory
{
    public function definition()
    {
        return [
            'name' => $this->faker->word,
            'slug' => Str::slug($this->faker->unique()->word),
            'thumb_image' => $this->faker->imageUrl(400, 300, 'products'),
            'vendor_id' => \App\Models\Vendor::factory(),
            'brand_id' => \App\Models\Brand::factory(),
            'category_id' => \App\Models\Category::factory(),
            'subCategory_id' => \App\Models\SubCategory::factory(),
            'childCategory_id' => \App\Models\ChildCategory::factory(),
            'qty' => $this->faker->numberBetween(1, 100),
            'short_description' => $this->faker->sentence,
            'long_description' => $this->faker->paragraph,
            'video_link' => $this->faker->url,
            'sku' => $this->faker->unique()->numerify('SKU-#####'),
            'price' => $this->faker->randomFloat(2, 10, 500),
            'offer_price' => $this->faker->optional()->randomFloat(2, 5, 400),
            'offer_start_date' => $this->faker->optional()->dateTimeBetween('-1 month', 'now'),
            'offer_end_date' => $this->faker->optional()->dateTimeBetween('now', '+1 month'),
            'is_top' => $this->faker->boolean,
            'is_best' => $this->faker->boolean,
            'is_featured' => $this->faker->boolean,
            'status' => $this->faker->boolean,
            'is_approved' => $this->faker->boolean,
            'seo_title' => $this->faker->sentence,
            'seo_description' => $this->faker->paragraph,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}

class VendorFactory extends Factory
{
    public function definition()
    {
        return [
            'banner' => $this->faker->imageUrl(800, 400, 'vendor'),
            'store_name' => $this->faker->company,
            'phone' => $this->faker->phoneNumber,
            'email' => $this->faker->unique()->safeEmail,
            'description' => $this->faker->paragraph,
            'fb_link' => $this->faker->optional()->url,
            'x_link' => $this->faker->optional()->url,
            'insta_link' => $this->faker->optional()->url,
            'status' => $this->faker->boolean,
            'user_id' => \App\Models\User::factory(),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}

class UserFactory extends Factory
{
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'username' => $this->faker->unique()->userName,
            'email' => $this->faker->unique()->safeEmail,
            'email_verified_at' => now(),
            'image' => $this->faker->optional()->imageUrl(100, 100, 'users'),
            'role' => $this->faker->randomElement(['admin', 'vendor', 'customer']),
            'status' => $this->faker->boolean,
            'password' => bcrypt('password'),
            'remember_token' => Str::random(10),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}

class ProductVariantFactory extends Factory
{
    public function definition()
    {
        return [
            'name' => $this->faker->word,
            'status' => $this->faker->boolean,
            'product_id' => \App\Models\Product::factory(),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}

class ProductVariantIemFactory extends Factory
{
    public function definition()
    {
        return [
            'name' => $this->faker->word,
            'product_variant_id' => \App\Models\ProductVariant::factory(),
            'price' => $this->faker->randomFloat(2, 1, 100),
            'is_default' => $this->faker->boolean,
            'status' => $this->faker->boolean,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}

class ProductImageGalleryFactory extends Factory
{
    public function definition()
    {
        return [
            'image' => $this->faker->imageUrl(800, 600, 'gallery'),
            'product_id' => \App\Models\Product::factory(),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
