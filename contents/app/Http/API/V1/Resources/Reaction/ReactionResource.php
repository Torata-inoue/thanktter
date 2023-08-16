<?php

namespace App\Http\API\V1\Resources\Reaction;

use App\Domains\Reaction\Reaction;
use App\Domains\Reaction\ReactionType;
use App\Http\API\V1\Resources\BaseResource;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

/**
 * @extends BaseResource<Collection<int, Reaction>>
 */
class ReactionResource extends BaseResource
{
    /**
     * @param Request $request
     * @return array<ReactionType::name, int>
     */
    public function toArray(Request $request): array
    {
        $reactions = $this->resource->keyBy('type');
        $response = [];
        foreach (ReactionType::cases() as $reactionType) {
            $response[$reactionType->getLowerText()] = $reactions->get("{$reactionType->value}")?->count ?? 0;
        }
        return $response;
    }
}
