<?php

namespace App\Library\ReactResponse\Comment;

use App\Domains\Comment\Comment;
use App\Library\ReactResponse\BaseResponse;
use App\Library\ReactResponse\User\UserResponse;

readonly class ReplyResponse extends BaseResponse
{
    /**
     * @param Comment $reply
     */
    public function __construct(private Comment $reply)
    {
        assert(isset($reply->user));
    }

    /**
     * @return array{
     *     user: UserResponse,
     *     text: string,
     *     replyId: int
     * }
     */
    public function jsonSerialize(): array
    {
        return [
            'user' => new UserResponse($this->reply->user),
            'text' => $this->reply->text,
            'replyId' => $this->reply->id
        ];
    }
}
