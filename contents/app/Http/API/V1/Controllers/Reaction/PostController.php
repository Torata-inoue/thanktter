<?php

namespace App\Http\API\V1\Controllers\Reaction;

use App\Http\API\V1\Requests\Reaction\PostRequest;
use App\Http\BaseController;
use App\Library\Http\Response\JsonResponse;
use Carbon\Carbon;

class PostController extends BaseController
{
    public function postReaction(PostRequest $request): JsonResponse
    {
//        $request->getValidData();

        $data = [
            'auth' => [
                'id' => 5,
                'name' => 'torata',
                'icon' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTzOI1ONa9PUcO7-UvwRf-Ow5tPKCUG0IQpSqkkdjdavw&s',
                'stamina' => 10,
            ],
            'comment' => [
                'id' => 10,
                'text' => 'ありがとう',
                'createdAt' => Carbon::now()->format('Y-m-d'),
                'user' => ['id' => 1, 'name' => 'tanaka', 'icon' => 'https://free-designer.net/design_img/1024043005.jpg'],
                'nominees' => [
                    ['id' => 2, 'name' => 'ito', 'icon' => 'https://free-designer.net/design_img/1229010007.jpg'],
                    ['id' => 3, 'name' => 'yashiro', 'icon' => 'https://free-designer.net/design_img/0216053006.jpg'],
                    ['id' => 4, 'name' => 'yossi', 'icon' => 'https://free-designer.net/design_img/0216053006.jpg'],
                ],
                'reactions' => [
                    'good' => 3,
                    'thanks' => 4,
                    'fight' => 6
                ],
                'replies' => [
                    [
                        'user' => ['id' => 1, 'name' => 'tanaka', 'icon' => 'https://free-designer.net/design_img/1024043005.jpg'],
                        'text' => 'どういたしまして'
                    ]
                ],
            ]
        ];
        return new JsonResponse(compact('data'));
    }
}
