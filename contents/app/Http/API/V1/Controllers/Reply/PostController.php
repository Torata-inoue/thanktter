<?php

namespace App\Http\API\V1\Controllers\Reply;

use App\Http\API\V1\Controllers\BaseController;
use App\Http\API\V1\Requests\Reply\PostReplyRequest;
use App\Library\Http\Response\JsonResponse;
use Carbon\Carbon;

class PostController extends BaseController
{
    public function postReply(PostReplyRequest $request): JsonResponse
    {
        $data = [
            'id' => 9,
            'text' => "今日は勝負の火種\n今日頑張れ",
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
                    'text' => 'がんばりました！',
                    'replyId' => 2
                ],
                [
                    'user' => ['id' => 4, 'name' => 'yossi', 'icon' => 'https://free-designer.net/design_img/0216053006.jpg'],
                    'text' => "今回はありがとうございました。\nまた今度お願いします！",
                    'replyId' => 3
                ],
                [
                    'user' => ['id' => 4, 'name' => 'yossi', 'icon' => 'https://free-designer.net/design_img/0216053006.jpg'],
                    'text' => "とんでもない\n頑張ってね",
                    'replyId' => 4
                ]
            ],
        ];
        return new JsonResponse(compact('data'));
    }
}
