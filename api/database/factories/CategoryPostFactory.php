<?php

namespace Database\Factories;

use App\Models\Post;
use App\Models\CategoryPost;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<CategoryPost>
 */
class CategoryPostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'uuid' => fake()->unique()->uuid(),
            'post_id' => null,
            'category_id' => null,
        ];
    }
}
