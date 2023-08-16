<?php

namespace App\Domains\Reaction;

enum ReactionType: int
{
    case GOOD = 1;
    case EMPATHY = 2;
    case THANKS = 3;
    case CONGRATULATION = 4;
    case FIGHT = 5;

    public function getLowerText(): string
    {
        return strtolower($this->name);
    }
}
