<?php

use Illuminate\Routing\Router;
use App\Library\Http\Response\JsonResponse;

/** @var Router $router */
$router->get('/', fn() => view('app'));

$router->group(['prefix' => 'api'], function (Router $router) {
    $router->group(['prefix' => 'v1'], function (Router $router) {
        $router->get('auth', fn () => new JsonResponse(['data' => [
            'id' => 5,
            'name' => 'torata',
            'icon' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTzOI1ONa9PUcO7-UvwRf-Ow5tPKCUG0IQpSqkkdjdavw&s'
        ]]));
    });
});
