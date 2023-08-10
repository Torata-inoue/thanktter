<?php

use Illuminate\Routing\Router;

/** @var Router $router */
$router->get('/', \App\Http\Admin\Controllers\Top\ShowTopController::class);
