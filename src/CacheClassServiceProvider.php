<?php

namespace KamilMakosa\LaravelCacheClass;

use KamilMakosa\LaravelCacheClass\Console\MakeCacheCommand;
use Illuminate\Support\ServiceProvider;

class CacheClassServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                MakeCacheCommand::class,
            ]);
        }
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        //
    }
}
