<?php

namespace Database\Seeders;

use App\Models\SeoSetting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SeoSettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $seoData = [

            // ------------------------------------
            // HOME
            // ------------------------------------
            [
                'page_type'     => 'home',
                'url_pattern'   => 'home',
                'meta_title'       => 'Welcome to Your Application',
                'meta_description' => 'Access your dashboard, manage users, roles, and system settings effortlessly.',
                'meta_keywords'    => 'home, dashboard, admin, management system',
            ],

            // ------------------------------------
            // DASHBOARD
            // ------------------------------------
            [
                'page_type'     => 'dashboard',
                'url_pattern'   => 'dashboard',
                'meta_title'    => 'Dashboard',
                'meta_description' => 'Overview of system statistics and insights.',
                'meta_keywords' => 'dashboard, admin panel',
            ],

            // ------------------------------------
            // AUTH
            // ------------------------------------
            [
                'page_type'     => 'auth',
                'url_pattern'   => 'login',
                'meta_title'    => 'Login - Access Your Account',
                'meta_description' => 'Login to your account to access all features.',
                'meta_keywords' => 'login, signin',
            ],
            [
                'page_type'     => 'auth',
                'url_pattern'   => 'register',
                'meta_title'    => 'Register - Create Account',
                'meta_description' => 'Register a new account and get started.',
                'meta_keywords' => 'register, signup',
            ],
            [
                'page_type'     => 'auth',
                'url_pattern'   => 'forgot-password',
                'meta_title'    => 'Forgot Password',
                'meta_description' => 'Recover your account password easily.',
                'meta_keywords' => 'forgot password, reset password',
            ],
            [
                'page_type'     => 'auth',
                'url_pattern'   => 'reset-password',
                'meta_title'    => 'Reset Password',
                'meta_description' => 'Reset your account password securely.',
                'meta_keywords' => 'reset password, new password',
            ],

            // ------------------------------------
            // USERS
            // ------------------------------------
            [
                'page_type'     => 'users',
                'url_pattern'   => 'users',
                'meta_title'    => 'Users - All Users',
                'meta_description' => 'Manage all registered users.',
                'meta_keywords' => 'users, admin users',
            ],
            [
                'page_type'     => 'users',
                'url_pattern'   => 'users/add',
                'meta_title'    => 'Add User',
                'meta_description' => 'Create a new user.',
                'meta_keywords' => 'add user, create user',
            ],
            [
                'page_type'     => 'users',
                'url_pattern'   => 'users/{id}/edit',
                'meta_title'    => 'Edit User',
                'meta_description' => 'Edit user details.',
                'meta_keywords' => 'edit user, update user',
            ],

            // ------------------------------------
            // ROLES
            // ------------------------------------
            [
                'page_type'     => 'roles',
                'url_pattern'   => 'roles',
                'meta_title'    => 'Roles - Manage Roles',
                'meta_description' => 'Manage user roles and permissions.',
                'meta_keywords' => 'roles, permissions',
            ],
            [
                'page_type'     => 'roles',
                'url_pattern'   => 'roles/add',
                'meta_title'    => 'Add Role',
                'meta_description' => 'Create a new role.',
                'meta_keywords' => 'add role, create role',
            ],
            [
                'page_type'     => 'roles',
                'url_pattern'   => 'roles/{id}/edit',
                'meta_title'    => 'Edit Role',
                'meta_description' => 'Edit role details.',
                'meta_keywords' => 'edit role, update role',
            ],

            // ------------------------------------
            // PERMISSIONS
            // ------------------------------------
            [
                'page_type'     => 'permissions',
                'url_pattern'   => 'permissions',
                'meta_title'    => 'Permissions - List',
                'meta_description' => 'View all permissions.',
                'meta_keywords' => 'permissions, spatie permissions',
            ],
            [
                'page_type'     => 'permissions',
                'url_pattern'   => 'permissions/add',
                'meta_title'    => 'Add Permission',
                'meta_description' => 'Create a new permission.',
                'meta_keywords' => 'add permission, create permission',
            ],
            [
                'page_type'     => 'permissions',
                'url_pattern'   => 'permissions/{id}/edit',
                'meta_title'    => 'Edit Permission',
                'meta_description' => 'Edit permission details.',
                'meta_keywords' => 'edit permission, update permission',
            ],

        ];

        SeoSetting::insert($seoData);
    }
}
