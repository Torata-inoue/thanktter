<?php

namespace App\Service\Reaction;

use App\Domains\Comment\Comment;
use App\Domains\Comment\CommentRepository;
use App\Domains\Reaction\Reaction;
use App\Domains\Reaction\ReactionRepository;
use App\Domains\Reaction\ReactionType;
use App\Domains\User\UserRepository;
use App\Service\BaseService;
use App\Service\MakeCommentTrait;

readonly class PostReactionService extends BaseService
{
    use MakeCommentTrait;

    public function __construct(
        private CommentRepository $commentRepository,
        private UserRepository $userRepository,
        private ReactionRepository $reactionRepository
    ) {
        parent::__construct();
    }

    /**
     * @param int $comment_id
     * @param int $target_id
     * @param ReactionType $reactionType
     * @return array{comment: Comment, reactions: array<array{type: int, count: int}>}
     * @throws \Exception
     */
    public function createReaction(int $comment_id, int $target_id, ReactionType $reactionType): array
    {
        $comment = $this->commentRepository->findById($comment_id);
        if (!$comment) {
            throw new \Exception('コメントが見つかりません');
        }

        $targetUser = $this->userRepository->findById($target_id);
        if (!$targetUser) {
            throw new \Exception('ユーザーが見つかりません');
        }

        $reaction = new Reaction([
            'comment_id' => $comment_id,
            'user_id' => $this->auth->id,
            'target_id' => $target_id,
            'type' => $reactionType->value
        ]);
        $this->reactionRepository->save($reaction);

        $reactions = $this->reactionRepository->countReactionsGroupByTypeByCommentIds([$comment_id]);

        return $this->makeComment($comment, $reactions);
    }
}
