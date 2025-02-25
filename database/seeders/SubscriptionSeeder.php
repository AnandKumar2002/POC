<?php

namespace Database\Seeders;

use App\Models\Subscription;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SubscriptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Subscription::insert([
            ['user_id' => 1, 'email' => 'subscriber1@example.com'],
            ['user_id' => 2, 'email' => 'subscriber2@example.com'],
            ['user_id' => null, 'email' => 'anonymous@example.com'],
        ]);
    }
}
