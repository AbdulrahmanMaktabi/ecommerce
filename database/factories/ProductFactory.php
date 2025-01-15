<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
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
