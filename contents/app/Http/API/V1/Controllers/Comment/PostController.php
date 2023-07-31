<?php

namespace App\Http\API\V1\Controllers\Comment;

use App\Http\API\V1\Requests\Comment\PostRequest;
use App\Http\BaseController;
use App\Library\Http\Response\JsonResponse;

class PostController extends BaseController
{
    public function post(PostRequest $request): JsonResponse
    {
        $data = $request->safe(['text', 'nomineeIds', 'images']);

        return new JsonResponse([]);
    }
}
