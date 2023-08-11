<?php

namespace App\Http\API\V1\Controllers\Comment;

use App\Http\API\V1\Controllers\BaseController;
use App\Http\API\V1\Requests\Comment\PostRequest;
use App\Http\API\V1\Resources\Comment\CommentResource;
use App\Library\Http\Response\JsonResponse;
use App\Service\Comment\SaveCommentService;

class PostController extends BaseController
{
    public function post(PostRequest $request, SaveCommentService $service): JsonResponse
    {
        $inputs = $request->only(['text', 'nomineeIds', 'images']);
        $data = $service->createComment($inputs['text'], $inputs['nomineeIds'], $inputs['images'] ?? []);

        return new JsonResponse(new CommentResource($data));
    }
}
