<?php

namespace App\Http\API\V1\Controllers\Reaction;

use App\Domains\Reaction\ReactionType;
use App\Http\API\V1\Controllers\BaseController;
use App\Http\API\V1\Requests\Reaction\PostRequest;
use App\Http\API\V1\Resources\Comment\CommentResource;
use App\Http\API\V1\Resources\User\UserResource;
use App\Library\Http\Response\JsonResponse;
use App\Service\Reaction\PostReactionService;
use Illuminate\Auth\AuthManager;

class PostController extends BaseController
{
    public function __construct(private AuthManager $authManager)
    {
    }

    public function postReaction(PostRequest $request, PostReactionService $service): JsonResponse
    {
        $inputs = $request->only(['commentId', 'userId', 'type']);
        $data = $service->createReaction(
            $inputs['commentId'],
            $inputs['userId'],
            ReactionType::from($inputs['type'])
        );
        $auth = $this->authManager->guard()->user();

        return new JsonResponse([
            'comment' => new CommentResource($data),
            'auth' => new UserResource($auth)
        ]);
    }
}
