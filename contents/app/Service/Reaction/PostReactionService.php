<?php

namespace App\Service\Reaction;

use App\Domains\Comment\Comment;
use App\Domains\Comment\CommentRepository;
use App\Domains\Reaction\Reaction;
use App\Domains\Reaction\ReactionRepository;
use App\Domains\Reaction\ReactionType;
use App\Domains\User\UserRepository;
use App\Service\BaseService;

readonly class PostReactionService extends BaseService
{
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
     * @return Comment
     * @throws \Exception
     */
    public function createReaction(int $comment_id, int $target_id, ReactionType $reactionType): Comment
    {
        $comment = $this->commentRepository->findById($comment_id);
        if (!$comment) {
            throw new \Exception('コメントが見つかりません');
        }

        $targetUser = $this->userRepository->findById($target_id);
        if (!$targetUser) {
            throw new \Exception('ユーザーが見つかりません');
        }

        if ($this->auth->stamina <= 0) {
            throw new \Exception('スタミナが足りません');
        }

        $this->auth->stamina--;
        $this->userRepository->save($this->auth);

        $reaction = new Reaction([
            'comment_id' => $comment_id,
            'user_id' => $this->auth->id,
            'target_id' => $target_id,
            'type' => $reactionType->value
        ]);
        $this->reactionRepository->save($reaction);

        $comment->reactions->transform(function (Reaction $reaction) use ($reactionType) {
            if ($reaction->type === $reactionType->value) {
                // @phpstan-ignore-next-line
                $reaction->count++;
            }
            return $reaction;
        });

        return $comment;
    }
}
