<?php

namespace Database\Seeders;

use App\Models\Like;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ViewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 15; $i++) {
            Like::create([
                'post_id' => rand(1, 5),
                'user_id' => rand(1, 3),
                'type' => (rand(0, 1) ? 'like' : 'dislike'),
            ]);
        }
    }
}
