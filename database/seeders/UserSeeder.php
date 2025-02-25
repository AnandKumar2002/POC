<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::insert([
            ['name' => 'Admin User', 'email' => 'admin@example.com', 'password' => Hash::make('password'), 'role_id' => 1],
            ['name' => 'Editor User', 'email' => 'editor@example.com', 'password' => Hash::make('password'), 'role_id' => 2],
            ['name' => 'Regular User', 'email' => 'user@example.com', 'password' => Hash::make('password'), 'role_id' => 3],
        ]);
    }
}
