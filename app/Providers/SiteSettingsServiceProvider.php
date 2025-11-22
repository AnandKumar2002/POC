<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\SiteSetting;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Schema;

class SiteSettingsServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot()
    {
        if (!Schema::hasTable('site_settings')) {
            return;
        }

        // Load settings from cache or DB
        $settings = Cache::rememberForever('settings_cache', function () {
            return SiteSetting::pluck('value', 'key')->toArray();
        });

        // Apply settings dynamically into config()
        foreach ($settings as $key => $value) {
            $this->applyConfig($key, $value);
        }
    }

    /**
     * Map database keys to Laravel config values
     */
    private function applyConfig($key, $value)
    {
        switch ($key) {

            case 'app_name':
                Config::set('app.name', $value);
                break;

            case 'app_env':
                Config::set('app.env', $value);
                break;

            case 'app_debug':
                Config::set('app.debug', filter_var($value, FILTER_VALIDATE_BOOLEAN));
                break;

            case 'app_url':
                Config::set('app.url', $value);
                break;

            case 'app_timezone':
                Config::set('app.timezone', $value);
                break;

            case 'app_locale':
                Config::set('app.locale', $value);
                break;

            case 'app_fallback_locale':
                Config::set('app.fallback_locale', $value);
                break;

            case 'app_tag_line':
                Config::set('app.tag_line', $value);
                break;

            case 'session_lifetime':
                Config::set('session.lifetime', intval($value));
                break;

            case 'session_driver':
                Config::set('session.driver', $value);
                break;

            case 'cache_store':
                Config::set('cache.default', $value);
                break;

            case 'mail_from_address':
                Config::set('mail.from.address', $value);
                break;

            case 'mail_from_name':
                Config::set('mail.from.name', $value);
                break;

            case 'seo_cache_time':
                Config::set('seo.cache_time', intval($value));
                break;

            default:
                // Automatically support future settings!
                break;
        }
    }
}
