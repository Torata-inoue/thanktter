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
        return $this->with('hasManyReplies.belongsToUser');
    }

    public function withNominees(): self
    {
        return $this->with('belongsToManyNominees');
    }

    public function withImages(): self
    {
        return $this->with('hasManyImages');
    }

    public function withReactions(): self
    {
        return $this->with('hasManyReactions');
    }

    public function withRelations(): self
    {
        return $this->withUser()
            ->withReplies()
            ->withNominees()
            ->withImages()
            ->withReactions();
    }
}
