<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class SiteSetting extends Model
{
    protected $fillable = [
        'key',
        'value'
    ];

    protected static function booted()
    {
        static::saved(function () {
            Cache::forget('settings_cache');
        });

        static::deleted(function () {
            Cache::forget('settings_cache');
        });
    }
}
