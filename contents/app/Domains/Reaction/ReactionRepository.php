<?php

namespace App\Domains\Reaction;

use App\Domains\Repository;

/**
 * @extends Repository<Reaction>
 */
class ReactionRepository extends Repository
{
    public function __construct(Reaction $reaction)
    {
        parent::__construct($reaction);
    }
}
