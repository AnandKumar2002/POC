<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $roles = Role::pluck('name')->toArray();

        foreach ($roles as $roleName) {

            $email = $roleName . '@' . $roleName . '.com';

            $user = User::updateOrCreate(
                ['email' => $email],
                [
                    'name' => ucfirst($roleName) . ' User',
                    'password' => Hash::make('password'),
                ]
            );

            $user->syncRoles([$roleName]);
        }

        $baseEmail = 'testuser';
        $password = Hash::make('password');

        for ($i = 1; $i <= 20; $i++) {
            $email = $baseEmail . $i . '@example.com';

            User::updateOrCreate(
                ['email' => $email],
                [
                    'name' => 'Test User ' . $i,
                    'password' => $password,
                    'email_verified_at' => now(),
                ]
            );
        }

        // If you want single user add!

        // $user = User::create([
        //     'name'     => 'Admin User',
        //     'email'    => 'admin@admin.com',
        //     'password' => bcrypt('password'),
        // ]);

        // $user->assignRole('admin');
    }
}
