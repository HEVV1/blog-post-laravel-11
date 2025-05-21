<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Comment;
use Random\RandomException;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Comment>
 */
class CommentFactory extends Factory
{
    /**
     * @return array<string, mixed>
     * @throws RandomException
     */
    public function definition(): array
    {
        return [
            'uuid' => fake()->unique()->uuid(),
            'content' => fake()->sentence(random_int(5, 15)),
            'user_id' => User::all()->random()->id,
        ];
    }
}
