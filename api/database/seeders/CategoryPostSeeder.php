<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\Category;
use Random\RandomException;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class CategoryPostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * @throws RandomException
     */
    public function run(): void
    {
        $posts = Post::all();
        $categories = Category::all();

        foreach ($posts as $post) {
            $ids = $categories
                ->random(random_int(1, 6))
                ->pluck('id');

            $pivotTable = $ids->mapWithKeys(static function ($id) {
                return [
                    $id => [
                        'uuid' => Str::uuid()
                            ->toString(),
                    ],
                ];
            })
                ->toArray();

            $post->categories()
                ->sync($pivotTable);
        }
    }
}
