<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Brand>
 */
class BrandFactory extends Factory
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
            'image' => $this->faker->imageUrl(100, 100, 'brand'),
            'status' => $this->faker->boolean,
            'featured' => $this->faker->boolean,
            'slug' => Str::slug($this->faker->unique()->word),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
