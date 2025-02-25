<?php

namespace Database\Seeders;

use App\Models\Post;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 5; $i++) {
            $title = "Post $i";
            Post::create([
                'title' => $title,
                'slug' => Str::slug($title),
                'content' => "This is dummy content for post $i.",
                'status' => 'published',
                'user_id' => rand(1, 3),
                'category_id' => rand(1, 3),
                'published_at' => now(),
            ]);
        }
    }
}
