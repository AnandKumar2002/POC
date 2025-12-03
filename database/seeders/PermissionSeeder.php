<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            // USER PERMISSIONS
            [
                'name' => 'impersonate user',
                'group' => 'user',
                'guard_name' => 'web'
            ],
            [
                'name' => 'view users',
                'group' => 'user',
                'guard_name' => 'web'
            ],
            [
                'name' => 'view user',
                'group' => 'user',
                'guard_name' => 'web'
            ],
            [
                'name' => 'insert user',
                'group' => 'user',
                'guard_name' => 'web'
            ],
            [
                'name' => 'update user',
                'group' => 'user',
                'guard_name' => 'web'
            ],
            [
                'name' => 'delete user',
                'group' => 'user',
                'guard_name' => 'web'
            ],
            // ROLE PERMISSIONS
            ['name' => 'view roles', 'group' => 'role', 'guard_name' => 'web'],
            ['name' => 'view role', 'group' => 'role', 'guard_name' => 'web'],
            ['name' => 'insert role', 'group' => 'role', 'guard_name' => 'web'],
            ['name' => 'update role', 'group' => 'role', 'guard_name' => 'web'],
            ['name' => 'delete role', 'group' => 'role', 'guard_name' => 'web'],
        ];

        DB::table('permissions')->insert($permissions);
    }
}
