<?php

use Illuminate\Routing\Router;

/** @var Router $router */
$router->post('/login', \App\Http\API\V1\Controllers\Auth\LoginController::class);
$router->post('/logout', \App\Http\API\V1\Controllers\Auth\LogoutController::class);
$router->get('auth', [\App\Http\API\V1\Controllers\Auth\GetAuthController::class, 'getAuth']);

$router->group(['middleware' => 'auth:sanctum'], function (Router $router) {
    $router->group(['prefix' => 'user'], function (Router $router) {
        $router->get('list', [\App\Http\API\V1\Controllers\User\List\GetUserListController::class, 'getUserList']);
    });

    $router->group(['prefix' => 'comment'], function (Router $router) {
        $router->get('/', [\App\Http\API\V1\Controllers\Comment\GetController::class, 'getComments']);
        $router->post('/', [\App\Http\API\V1\Controllers\Comment\PostController::class, 'post']);
    });

    $router->group(['prefix' => 'reply'], function (Router $router) {
        $router->post('/', [\App\Http\API\V1\Controllers\Reply\PostController::class, 'postReply']);
    });

    $router->group(['prefix' => 'reaction'], function (Router $router) {
        $router->post('/', [\App\Http\API\V1\Controllers\Reaction\PostController::class, 'postReaction']);
    });
});
