<?php

namespace App\Http\API\V1\Resources\Comment;

use App\Domains\Comment\Comment;
use App\Domains\User\User;
use App\Http\API\V1\Resources\BaseResource;
use App\Http\API\V1\Resources\Reaction\ReactionResource;
use App\Http\API\V1\Resources\User\UserResource;
use Illuminate\Http\Request;

/**
 * @extends BaseResource<Comment>
 */
class CommentResource extends BaseResource
{
    /**
     * @param Comment $comment
     * @param array<array{type: int, count: int}> $reactions
     */
    public function __construct(
        Comment $comment,
        private readonly array $reactions,
    ) {
        parent::__construct($comment);
    }

    /**
     * @param Request $request
     * @return array{
     *     id: int,
     *     text: string,
     *     createdAt: string,
     *     user: UserResource,
     *     nominees: UserResource[],
     *     reactions: ReactionResource,
     *     replies: ReplyResource[]
     * }
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->resource->id,
            'text' => $this->resource->text,
            'createdAt' => $this->resource->created_at->format('Y-m-d H:i:s'),
            'user' => new UserResource($this->resource->user),
            'nominees' => $this->resource->nominees->map(fn(User $user) => new UserResource($user))->all(),
            'reactions' => new ReactionResource($this->reactions),
            'replies' => $this->resource->replies->map(fn(Comment $comment) => new ReplyResource($comment))->all()
        ];
    }
}
