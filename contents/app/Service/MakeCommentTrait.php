<?php

namespace App\Service;

use App\Domains\Comment\Comment;
use App\Domains\Reaction\ReactionType;

trait MakeCommentTrait
{
    /**
     * @param Comment $comment
     * @param array<int, array<int, array{count: int}>> $reactions
     * @return array{comment: Comment, reactions: array<array{type: int, count: int}>}
     */
    private function makeComment(Comment $comment, array $reactions): array
    {
        return [
            'comment' => $comment,
            'reactions' => array_map(fn (ReactionType $type) => [
                'type' => $type->value,
                'count' => $this->arrayGetReaction($reactions, $comment->id, $type)
            ], ReactionType::cases()),
        ];
    }

    /**
     * @param array<int, array<int, array{count: int}>> $reactions
     * @param int $comment_id
     * @param ReactionType $type
     * @return int
     */
    private function arrayGetReaction(array $reactions, int $comment_id, ReactionType $type): int
    {
        return $reactions[$comment_id][$type->value]['count'] ?? 0;
    }
}
