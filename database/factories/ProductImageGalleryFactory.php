<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProductImageGallery>
 */
class ProductImageGalleryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
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
