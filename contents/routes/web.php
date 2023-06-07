<?php

use Illuminate\Routing\Router;
use App\Library\Http\Response\JsonResponse;

/** @var Router $router */
$router->get('/', fn() => view('app'));

$router->group(['prefix' => 'api'], function (Router $router) {
    $router->group(['prefix' => 'v1'], function (Router $router) {
        $router->get('auth', [\App\Http\Controllers\API\V1\Auth\GetAuthController::class, 'getAuth']);

        $router->group(['prefix' => 'user'], function (Router $router) {
            $router->get('list', [\App\Http\Controllers\API\V1\User\List\GetUserListController::class, 'getUserList']);
        });
    });
});
