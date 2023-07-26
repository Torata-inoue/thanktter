<?php

namespace App\Providers;

use App\Domains\Cache\CacheObserver;
use Carbon\Laravel\ServiceProvider;

class CacheServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $cacheObserver = CacheObserver::class;
    }

    public function register(): void
    {
        //
    }
}
