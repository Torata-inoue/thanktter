<?php

namespace App\Http\Controllers\API\V1\Auth;

use App\Http\Controllers\Controller;
use App\Library\Http\Response\JsonResponse;

class GetAuthController extends Controller
{
    public function getAuth(): JsonResponse
    {
        return new JsonResponse(['data' => [
            'id' => 5,
            'name' => 'torata',
            'icon' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTzOI1ONa9PUcO7-UvwRf-Ow5tPKCUG0IQpSqkkdjdavw&s'
        ]]);
    }
}
