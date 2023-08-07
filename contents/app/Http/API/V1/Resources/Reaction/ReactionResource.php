<?php

namespace App\Http\API\V1\Resources\Reaction;

use App\Domains\Reaction\ReactionType;
use App\Http\API\V1\Resources\BaseResource;
use Illuminate\Http\Request;

/**
 * @extends BaseResource<array<array{type: int, count: int}>>
 */
class ReactionResource extends BaseResource
{
    /**
     * @return array<string, int>
     */
    public function toArray(Request $request): array
    {
        $reactions = [];
        foreach ($this->resource as ['type' => $type, 'count' => $count]) {
            $text = ReactionType::from($type)->getText();
            $reactions[$text] = $count;
        }
        return $reactions;
    }
}
