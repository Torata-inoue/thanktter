<?php

use Illuminate\Routing\Router;

/** @var Router $router */
$router->get('/', [\App\Http\Web\Controllers\Top\TopBaseController::class, 'index']);
