<?php

namespace App\Service\Comment;

use App\Domains\Comment\Comment;
use App\Domains\Comment\CommentRepository;
use App\Domains\Reaction\ReactionRepository;
use App\Service\MakeCommentTrait;
use Illuminate\Database\Eloquent\Collection;

readonly class GetCommentsService
{
    use MakeCommentTrait;

    const PER_PAGE = 20;

    public function __construct(
        private CommentRepository $commentRepository,
        private ReactionRepository $reactionRepository,
    ) {
    }

    /**
     * @param int $page
     * @return array<array{
     *     comment: Comment,
     *     reactions: array<array{type: int, count: int}>
     * }>
     */
    public function getList(int $page): array
    {
        $comments = $this->getComments($page);
        $reactions = $this->getReactions($comments->pluck('id')->all());

        return $comments->map(fn (Comment $comment) => $this->makeComment($comment, $reactions))->all();
    }

    /**
     * @param int $page
     * @return Collection<int, Comment>
     */
    private function getComments(int $page): Collection
    {
        $offset = ($page - 1) * self::PER_PAGE;
        return $this->commentRepository->getComments(self::PER_PAGE, $offset);
    }

    /**
     * @param int[] $comment_ids
     * @return array<int, array<int, array{count: int}>>
     */
    private function getReactions(array $comment_ids): array
    {
        return $this->reactionRepository->countReactionsGroupByTypeByCommentIds($comment_ids);
    }
}
