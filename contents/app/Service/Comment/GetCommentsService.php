<?php

namespace App\Service\Comment;

use App\Domains\Comment\Comment;
use App\Domains\Comment\CommentRepository;
use Illuminate\Database\Eloquent\Collection;

readonly class GetCommentsService
{
    const PER_PAGE = 20;

    public function __construct(
        private CommentRepository $commentRepository,
    ) {
    }

    /**
     * @param int $page
     * @return Collection<int, Comment>
     */
    public function getComments(int $page): Collection
    {
        $offset = ($page - 1) * self::PER_PAGE;
        return $this->commentRepository->getComments(self::PER_PAGE, $offset);
    }
}
