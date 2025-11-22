<?php

namespace Database\Seeders;

use App\Models\SiteSetting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SiteSettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $settings = [

            // APP
            ['key' => 'app_name', 'value' => 'MY WEBSITE'],
            ['key' => 'app_env', 'value' => 'local'],
            ['key' => 'app_debug', 'value' =>  true],
            ['key' => 'app_url', 'value' =>  'http://localhost:8000'],
            ['key' => 'app_locale', 'value' =>  'en'],
            ['key' => 'app_fallback_locale', 'value' =>  'en'],
            ['key' => 'app_timezone', 'value' => 'Asia/Kolkata'],
            ['key' => 'app_tag_line', 'value' => 'Your awesome tagline here'],

            // SESSION
            ['key' => 'session_driver', 'value' =>  'database'],
            ['key' => 'session_lifetime', 'value' => '120'],

            // CACHE
            ['key' => 'cache_store', 'value' => 'database'],

            // SEO
            ['key' => 'seo_cache_time', 'value'  => 100],

            // MAIL
            ['key' => 'mail_from_address', 'value' => 'mail@example.com'],
            ['key' => 'mail_from_name', 'value' => 'MAIL'],
        ];

        foreach ($settings as $setting) {
            SiteSetting::updateOrCreate(
                ['key' => $setting['key']],
                ['value' => $setting['value']]
            );
        }
    }
}
