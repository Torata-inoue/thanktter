<?php

namespace App\Service\Reply;

use App\Domains\Comment\Comment;
use App\Domains\Comment\CommentRepository;
use App\Domains\Reaction\ReactionRepository;
use App\Service\BaseService;
use App\Service\MakeCommentTrait;

readonly class PostService extends BaseService
{
    use MakeCommentTrait;

    public function __construct(
        private CommentRepository $commentRepository,
        private ReactionRepository $reactionRepository
    ) {
        parent::__construct();
    }

    /**
     * @param int $comment_id
     * @param string $text
     * @return array{comment: Comment, reactions: array<array{type: int, count: int}>}
     * @throws \Exception
     */
    public function createReply(int $comment_id, string $text): array
    {
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
        $reactions = $this->reactionRepository->countReactionsGroupByTypeByCommentIds([$comment_id]);

        return $this->makeComment($parentComment, $reactions);
    }
}
