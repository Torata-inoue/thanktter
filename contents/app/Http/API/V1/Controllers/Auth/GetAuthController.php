<?php

namespace App\Http\API\V1\Controllers\Auth;

use App\Http\BaseController;
use App\Library\Http\Response\JsonResponse;

class GetAuthController extends BaseController
{
    public function getAuth(): JsonResponse
    {
        return new JsonResponse(['data' => [
            'id' => 5,
            'name' => 'torata',
            'icon' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTzOI1ONa9PUcO7-UvwRf-Ow5tPKCUG0IQpSqkkdjdavw&s',
            'stamina' => 10,
        ]]);
    }
}
