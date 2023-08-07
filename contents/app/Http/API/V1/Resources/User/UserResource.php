<?php

namespace App\Http\API\V1\Resources\User;

use App\Domains\User\User;
use App\Http\API\V1\Resources\BaseResource;
use Illuminate\Http\Request;

/**
 * @extends BaseResource<User>
 */
class UserResource extends BaseResource
{
    /**
     * @return array{id: int, name: string, icon_path: string}
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->resource->id,
            'name' => $this->resource->name,
            'icon_path' => $this->resource->icon_path
        ];
    }
}
