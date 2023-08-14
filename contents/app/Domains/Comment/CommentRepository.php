<?php

namespace App\Domains\Comment;

use App\Domains\Cache\CacheableRepository;
use Illuminate\Database\Eloquent\Collection;

/**
 * @extends CacheableRepository<Comment, CommentBuilder>
 */
class CommentRepository extends CacheableRepository
{
    public function __construct(Comment $comment)
    {
        parent::__construct($comment);
    }

    /**
     * @param int $limit
     * @param int $offset
     * @return Collection<int, Comment>
     */
    public function getComments(int $limit, int $offset): Collection
    {
        return $this->getQueryBuilder()
            ->withUser()
            ->withNominees()
            ->withReplies()
            ->withImages()
            ->where('status', '=', Comment::STATUS_EXIST)
            ->offset($offset)
            ->limit($limit)
            ->orderBy('id', 'desc')
            ->get();
    }

    public function save(Comment $comment): bool
    {
        return $comment->save();
    }
}
