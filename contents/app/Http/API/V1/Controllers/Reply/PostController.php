<?php

namespace App\Http\API\V1\Controllers\Reply;

use App\Http\API\V1\Controllers\BaseController;
use App\Http\API\V1\Requests\Reply\PostReplyRequest;
use App\Http\API\V1\Resources\Comment\CommentResource;
use App\Library\Http\Response\JsonResponse;
use App\Service\Reply\PostService;
use Carbon\Carbon;

class PostController extends BaseController
{
    public function postReply(PostReplyRequest $request, PostService $service): JsonResponse
    {
        $input = $request->only(['commentId', 'text']);
        $data = $service->createReply($input['commentId'], $input['text']);
        return new JsonResponse(new CommentResource($data));
    }
}
