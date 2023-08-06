<?php

namespace App\Domains\Reaction;

enum ReactionType: int
{
    case GOOD = 1;
    case EMPATHY = 2;
    case THANKS = 3;
    case CONGRATULATION = 4;
    case FIGHT = 5;

    public function getText(): string
    {
        return match ($this) {
            self::GOOD => 'good',
            self::EMPATHY => 'empathy',
            self::THANKS => 'thanks',
            self::CONGRATULATION => 'congratulation',
            self::FIGHT => 'fight',
        };
    }
}
