<?php

use Illuminate\Routing\Router;

/** @var Router $router */
$router->get('auth', [\App\Http\API\V1\Controllers\Auth\GetAuthController::class, 'getAuth']);

$router->group(['prefix' => 'user'], function (Router $router) {
    $router->get('list', [\App\Http\API\V1\Controllers\User\List\GetUserListBaseController::class, 'getUserList']);
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

