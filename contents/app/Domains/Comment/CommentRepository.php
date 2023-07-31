<?php

namespace App\Domains\Comment;

use App\Domains\Cache\CacheableRepository;

/**
 * @extends CacheableRepository<Comment>
 */
class CommentRepository extends CacheableRepository
{
    public function __construct(Comment $comment)
    {
        parent::__construct($comment);
    }
}
