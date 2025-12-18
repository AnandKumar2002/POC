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
        // Define specific administrative accounts
        $admins = [
            [
                'name'     => 'Super Admin',
                'email'    => 'super@example.com',
                'role'     => 'super-admin',
            ],
            [
                'name'     => 'Admin User',
                'email'    => 'admin@example.com',
                'role'     => 'admin',
            ],
        ];

        foreach ($admins as $adminData) {
            $user = User::firstOrCreate(
                ['email' => $adminData['email']],
                [
                    'name'              => $adminData['name'],
                    'password'          => Hash::make('password'),
                    'email_verified_at' => now(),
                ]
            );
            $user->assignRole($adminData['role']);
        }

        // Use Factories to create 10 regular users
        User::factory(10)->create()->each(function ($user) {
            $user->assignRole('user');
        });
    }
}
