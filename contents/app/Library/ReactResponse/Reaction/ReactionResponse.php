<?php

namespace App\Library\ReactResponse\Reaction;

use App\Domains\Reaction\ReactionType;
use App\Library\ReactResponse\BaseResponse;

readonly class ReactionResponse extends BaseResponse
{
    /**
     * @param array{type: int, count: int}[] $reactions
     */
    public function __construct(private array $reactions)
    {
    }

    /**
     * @return array<string, int>
     */
    public function jsonSerialize(): array
    {
        $reactions = [];
        foreach ($this->reactions as $reaction) {
            $text = ReactionType::from($reaction['type'])->getText();
            $reactions[$text] = $reaction['count'];
        }
        return $reactions;
    }
}
