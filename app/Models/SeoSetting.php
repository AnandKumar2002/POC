<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class SeoSetting extends Model
{
    protected $table = 'seo_settings';

    protected $fillable = [
        'page_type',
        'url_pattern',

        'meta_title',
        'meta_description',
        'meta_keywords',

        'canonical_url',

        'og_title',
        'og_description',
        'og_image',

        'twitter_title',
        'twitter_description',
        'twitter_image',

        'status',
    ];

    protected $casts = [
        'status' => 'boolean',
    ];

    protected static function booted()
    {
        static::saved(function () {
            Cache::forget('seo_cache');
            Cache::forget('settings_cache');
        });

        static::deleted(function () {
            Cache::forget('seo_cache');
            Cache::forget('settings_cache');
        });
    }
}
