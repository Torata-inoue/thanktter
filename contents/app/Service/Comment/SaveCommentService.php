<?php

namespace App\Service\Comment;

use App\Domains\Comment\Comment;
use App\Domains\Comment\CommentRepository;
use App\Domains\Nominee\Nominee;
use App\Domains\Nominee\NomineeRepository;
use App\Domains\Reaction\ReactionType;
use App\Domains\User\UserRepository;
use App\Service\BaseService;
use Illuminate\Database\Eloquent\Collection;

readonly class SaveCommentService extends BaseService
{
    public function __construct(
        private CommentRepository $commentRepository,
        private NomineeRepository $nomineeRepository,
        private UserRepository $userRepository
    ) {
        parent::__construct();
    }

    /**
     * @param string $text
     * @param int[] $nomineeIds
     * @param resource[] $images
     * @return array{comment: Comment, reactions: array<int, int>[]}
     * @throws \Throwable
     */
    public function createComment(string $text, array $nomineeIds, array $images): array
    {
        $comment = new Comment([
            'user_id' => $this->auth->id,
            'text' => $text
        ]);

        $users = $this->userRepository->getByIds($nomineeIds);
        \DB::transaction(function () use ($comment, $users) {
            $this->commentRepository->save($comment);

            foreach ($users as $user) {
                $nominee = new Nominee([
                    'comment_id' => $comment->id,
                    'user_id' => $user->id
                ]);
                $this->nomineeRepository->save($nominee);
            }
        });

        $comment->user = $this->auth;
        $comment->replies = new Collection();
        $comment->nominees = $users;

        return [
            'comment' => $comment,
            'reactions' => [
                ['type' => ReactionType::GOOD->value, 'count' => 0],
                ['type' => ReactionType::EMPATHY->value, 'count' => 0],
                ['type' => ReactionType::THANKS->value, 'count' => 0],
                ['type' => ReactionType::CONGRATULATION->value, 'count' => 0],
                ['type' => ReactionType::FIGHT->value, 'count' => 0],
            ]
        ];
    }
}
