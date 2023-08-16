<?php

namespace App\Service\Reply;

use App\Domains\Comment\Comment;
use App\Domains\Comment\CommentRepository;
use App\Service\BaseService;

readonly class PostService extends BaseService
{
    public function __construct(
        private CommentRepository $commentRepository
    ) {
        parent::__construct();
    }

    /**
     * @param int $comment_id
     * @param string $text
     * @return Comment
     * @throws \Exception
     */
    public function createReply(int $comment_id, string $text): Comment
    {
        $this->commentRepository->setUseCache(false);
        $parentComment = $this->commentRepository->findById($comment_id);
        if (!$parentComment) {
            throw new \Exception('データが存在しません');
        }
        $reply = new Comment([
            'reply_to' => $parentComment->id,
            'text' => $text,
            'user_id' => $this->auth->id,
        ]);
        $this->commentRepository->save($reply);
        $reply->user = $this->auth;

        $parentComment->replies->prepend($reply);

        return $parentComment;
    }
}
