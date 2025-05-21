<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\Comment;
use Random\RandomException;
use Illuminate\Database\Seeder;

class CommentSeeder extends Seeder
{
    /**
     * @throws RandomException
     */
    public function run(): void
    {
        $posts = Post::all();

        foreach ($posts as $post) {
            if (random_int(1, count($posts)) < 70) {
                $commentPerEachPost = random_int(1, 3);

                Comment::factory()
                    ->count($commentPerEachPost)
                    ->state(fn() => [
                        'post_id' => $post->id,
                    ])
                    ->create();
            }
        }
    }
}
