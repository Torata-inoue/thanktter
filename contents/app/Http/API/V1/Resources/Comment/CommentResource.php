<?php

namespace App\Http\API\V1\Resources\Comment;

use App\Domains\Comment\Comment;
use App\Domains\Comment\Image\CommentImage;
use App\Http\API\V1\Resources\BaseResource;
use App\Http\API\V1\Resources\Reaction\ReactionResource;
use App\Http\API\V1\Resources\User\UserResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

/**
 * @extends BaseResource<array{
 *     comment: Comment,
 *     reactions: array<array{type: int, count: int}>
 *     }>
 */
class CommentResource extends BaseResource
{
    /**
     * @param Request $request
     * @return array{
     *     id: int,
     *     text: string,
     *     createdAt: string,
     *     user: UserResource,
     *     nominees: ResourceCollection<UserResource>,
     *     reactions: ReactionResource,
     *     replies: ResourceCollection<ReplyResource>
     * }
     */
    public function toArray(Request $request): array
    {
        /** @var Comment $comment */
        $comment = $this->resource['comment'];
        /** @var array<array{type: int, count: int}> $reactions */
        $reactions = $this->resource['reactions'];
        return [
            'id' => $comment->id,
            'text' => $comment->text,
            'createdAt' => $comment->created_at->format('Y/n/j G:i'),
            'user' => new UserResource($comment->user),
            'nominees' => UserResource::collection($comment->nominees),
            'reactions' => new ReactionResource($reactions),
            'replies' => ReplyResource::collection($comment->replies),
            'images' => $comment->images->map(fn (CommentImage $commentImage) => $commentImage->getUrl())
        ];
    }
}
