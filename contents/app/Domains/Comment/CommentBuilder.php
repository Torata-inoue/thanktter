<?php

namespace App\Domains\Comment;

use Illuminate\Database\Eloquent\Builder;

/**
 * @extends Builder<Comment>
 */
class CommentBuilder extends Builder
{
    public function withUser(): self
    {
        return $this->with('belongsToUser');
    }

    public function withReplies(): self
    {
        return $this->with('hasManyReplies');
    }

    public function withNominees(): self
    {
        return $this->with('belongsToManyNominees');
    }
}
