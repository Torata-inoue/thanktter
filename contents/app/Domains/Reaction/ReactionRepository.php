<?php

namespace App\Domains\Reaction;

use App\Domains\Repository;
use Illuminate\Database\Eloquent\Builder;

/**
 * @extends Repository<Reaction, Builder<Reaction>>
 */
class ReactionRepository extends Repository
{
    public function __construct(Reaction $reaction)
    {
        parent::__construct($reaction);
    }

    public function save(Reaction $reaction): bool
    {
        return $reaction->save();
    }
}
