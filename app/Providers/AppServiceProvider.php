<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Console\Scheduling\Schedule;
use App\Jobs\ConvertNewImagesToWebP;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->app->resolving(Schedule::class, function (Schedule $schedule) {
            $schedule->job(new ConvertNewImagesToWebP())->everyMinute(); // Runs every day
        });
    }
}
