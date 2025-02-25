<?php

namespace Database\Seeders;

use App\Models\Comment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 10; $i++) {
            Comment::create([
                'post_id' => rand(1, 5),
                'user_id' => rand(1, 3),
                'content' => "This is a dummy comment $i.",
            ]);
        }
    }
}
