<?php

namespace App\Providers;

use App\Domains\Cache\CacheObserver;
use App\Domains\Comment\Comment;
use App\Domains\User\User;
use Carbon\Laravel\ServiceProvider;

class CacheServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $cacheObserver = CacheObserver::class;
        User::observe($cacheObserver);
        Comment::observe($cacheObserver);
    }

    public function register(): void
    {
        //
    }
}
