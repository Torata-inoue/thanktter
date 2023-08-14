<?php

namespace App\Http\API\V1\Controllers\Reaction;

use App\Domains\Reaction\ReactionType;
use App\Http\API\V1\Controllers\BaseController;
use App\Http\API\V1\Requests\Reaction\PostRequest;
use App\Library\Http\Response\JsonResponse;
use App\Service\Reaction\PostReactionService;

class PostController extends BaseController
{
    public function postReaction(PostRequest $request, PostReactionService $service): JsonResponse
    {
        $inputs = $request->only(['commentId', 'userId', 'type']);
        $data = $service->createReaction(
            $inputs['commentId'],
            $inputs['userId'],
            ReactionType::from($inputs['type'])
        );
        return new JsonResponse($data);
    }
}
