<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Post;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    public function run(): void
    {
        $listOfUsers = User::all();

        for ($i = 0; $i < 100; $i++) {
            $user = $listOfUsers->random();
            Post::factory()->create([
                'user_id' => $user->id,
            ]);
        }
    }
}