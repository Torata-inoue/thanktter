<?php

namespace App\Http\API\V1\Controllers\Comment;

use App\Http\BaseController;
use App\Library\Http\Response\JsonResponse;
use Carbon\Carbon;

class GetController extends BaseController
{
    public function getComments(): JsonResponse
    {
        return new JsonResponse([
            [
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
                    'good' => 2,
                    'thanks' => 4,
                    'fight' => 6
                ],
                'replies' => [
                    [
                        'user' => ['id' => 1, 'name' => 'tanaka', 'icon' => 'https://free-designer.net/design_img/1024043005.jpg'],
                        'text' => 'どういたしまして'
                    ]
                ],
            ],
            [
                'id' => 9,
                'text' => '今日頑張れ',
                'createdAt' => Carbon::now()->format('Y-m-d'),
                'user' => ['id' => 5, 'name' => 'take', 'icon' => 'https://free-designer.net/design_img/0216053006.jpg'],
                'nominees' => [
                    ['id' => 2, 'name' => 'ito', 'icon' => 'https://free-designer.net/design_img/1229010007.jpg'],
                    ['id' => 3, 'name' => 'yashiro', 'icon' => 'https://free-designer.net/design_img/0216053006.jpg'],
                    ['id' => 4, 'name' => 'yossi', 'icon' => 'https://free-designer.net/design_img/0216053006.jpg'],
                ],
                'reactions' => [
                    'good' => 2,
                    'thanks' => 4,
                    'fight' => 6
                ],
                'replies' => [
                    [
                        'user' => ['id' => 5, 'name' => 'take', 'icon' => 'https://free-designer.net/design_img/0216053006.jpg'],
                        'text' => 'がんばりました！'
                    ]
                ],
            ]
        ]);
    }
}
