<?php

namespace App\Library\ReactResponse\User;

use App\Domains\User\User;
use App\Library\ReactResponse\BaseResponse;

readonly class UserResponse extends BaseResponse
{
    public function __construct(private User $user)
    {
    }

    /**
     * @return array{id: int, name: string, icon_path: string}
     */
    public function jsonSerialize(): array
    {
        return [
            'id' => $this->user->id,
            'name' => $this->user->name,
            'icon_path' => $this->user->icon_path
        ];
    }
}
