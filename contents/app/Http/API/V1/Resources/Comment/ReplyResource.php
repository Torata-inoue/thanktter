<?php

namespace App\Http\API\V1\Resources\Comment;

use App\Domains\Comment\Comment;
use App\Http\API\V1\Resources\BaseResource;
use App\Http\API\V1\Resources\User\UserResource;
use Illuminate\Http\Request;

/**
 * @extends BaseResource<Comment>
 */
class ReplyResource extends BaseResource
{
    /**
     * @return array{
     *     user: UserResource,
     *     text: string,
     *     replyId: int
     * }
     */
    public function toArray(Request $request): array
    {
        return [
            'user' => new UserResource($this->resource->user),
            'text' => $this->resource->text,
            'replyId' => $this->resource->id
        ];
    }
}
