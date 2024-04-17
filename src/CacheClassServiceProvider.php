<?php

namespace KamilMakosa\CacheClass;

use Illuminate\Support\ServiceProvider;
use KamilMakosa\CacheClass\Console\MakeCacheClass;

class CacheClassServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->mergeConfigFrom(__DIR__. '/../config/cache_class.php', 'cache_class');
    }

    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                MakeCacheClass::class,
            ]);
        }
    }
}
