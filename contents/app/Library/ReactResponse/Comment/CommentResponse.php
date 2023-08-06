<?php

namespace App\Library\ReactResponse\Comment;

use App\Domains\Comment\Comment;
use App\Domains\Nominee\Nominee;
use App\Library\ReactResponse\BaseResponse;
use App\Library\ReactResponse\User\UserResponse;
use Illuminate\Database\Eloquent\Collection;

readonly class CommentResponse extends BaseResponse
{
    /**
     * @param Comment $comment
     * @param Collection<int, Nominee> $nominees
     * @param array<int, int> $reactions
     */
    public function __construct(
        private Comment    $comment,
        private Collection $nominees,
        private array      $reactions,
    ) {
        assert(isset($comment->user));
        assert(isset($comment->replies));
    }

    /**
     * @return array{
     *     id: int,
     *     text: string,
     *     createdAt: string,
     *     user: UserResponse,
     *     nominees: UserResponse[],
     *     reactions: array<int, int>,
     *     replies: ReplyResponse[]
     * }
     */
    public function jsonSerialize(): array
    {
        return [
            'id' => $this->comment->id,
            'text' => $this->comment->text,
            'createdAt' => $this->comment->created_at->format('Y-m-d H:i:s'),
            'user' => new UserResponse($this->comment->user),
            'nominees' => $this->nominees->map(function (Nominee $nominee) {
                assert(isset($nominee->user));
                return new UserResponse($nominee->user);
            })->all(),
            'reactions' => $this->reactions,
            'replies' => $this->comment->replies->map(fn(Comment $comment) => new ReplyResponse($comment))->all()
        ];
    }
}
