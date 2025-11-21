<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

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
                    'password' => bcrypt('password'),
                ]
            );

            $user->syncRoles([$roleName]);
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
