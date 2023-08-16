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
 * @extends BaseResource<Comment>
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
        return [
            'id' => $this->resource->id,
            'text' => $this->resource->text,
            'createdAt' => $this->resource->created_at->format('Y/n/j G:i'),
            'user' => new UserResource($this->resource->user),
            'nominees' => UserResource::collection($this->resource->nominees),
            'reactions' => new ReactionResource($this->resource->reactions),
            'replies' => ReplyResource::collection($this->resource->replies),
            'images' => $this->resource->images->map(fn (CommentImage $commentImage) => $commentImage->getUrl())
        ];
    }
}
