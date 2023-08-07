<?php

namespace App\Http\API\V1\Resources\Auth;

use App\Domains\User\User;
use App\Http\API\V1\Resources\BaseResource;
use Illuminate\Http\Request;

/**
 * @extends BaseResource<User>
 */
class AuthResource extends BaseResource
{
    /**
     * @param Request $request
     * @return array{user: User}
     */
    public function toArray(Request $request): array
    {
        return [
            'user' => $this->resource
        ];
    }
}
