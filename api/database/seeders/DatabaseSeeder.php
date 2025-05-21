<?php

namespace Database\Seeders;

use App\Models\User;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Factories\PostFactory;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()
            ->create([
                'name' => 'hevv1',
                'email' => 'jurik256@gmail.com',
            ]);

        User::factory(10)
            ->create();

        $this->call([
            CategorySeeder::class,
            PostSeeder::class,
            CategoryPostSeeder::class,
        ]);
    }
}
