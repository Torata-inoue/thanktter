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

    /**
     * @param int[] $comment_ids
     * @return array<int, array<int, array{count: int}>>
     */
    public function countReactionsGroupByTypeByCommentIds(array $comment_ids): array
    {
        return $this->getQueryBuilder()
            ->selectRaw('`comment_id`, `type`, COUNT(*) as count')
            ->whereIn('comment_id', $comment_ids)
            ->groupBy(['comment_id', 'type'])
            ->get()
            ->groupBy(['comment_id', 'type'])
            ->toArray();
    }

    public function save(Reaction $reaction): bool
    {
        return $reaction->save();
    }
}
