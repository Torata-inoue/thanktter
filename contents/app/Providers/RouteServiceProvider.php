<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Routing\Router;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to your application's "home" route.
     *
     * Typically, users are redirected here after authentication.
     *
     * @var string
     */
    public const HOME = '/';

    /**
     * Define your route model bindings, pattern filters, and other route configuration.
     */
    public function boot(): void
    {
        $router = $this->app->make('router');

        $router->group([
            'middleware' => 'web'
        ], function (Router $router) {
            require base_path('routes/web.php');
        });

        $router->group([
            'prefix' => 'api',
            'middleware' => 'web'
        ], function (Router $router) {
            $router->group(['prefix' => 'v1'], function (Router $router) {
                require base_path('routes/api/v1.php');
            });
        });

        $router->group([
            'prefix' => 'admin',
            'middleware' => 'admin'
        ], function (Router $router) {
            require base_path('routes/admin.php');
        });
    }
}
