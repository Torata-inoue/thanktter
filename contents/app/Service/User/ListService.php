<?php

namespace App\Service\User;

use App\Domains\User\User;
use App\Domains\User\UserRepository;

readonly class ListService
{
    public function __construct(private UserRepository $userRepository)
    {
    }

    /**
     * @return array{id: int, name: string, icon_path: string}[]
     */
    public function getUserList(): array
    {
        return $this->userRepository->getUsersByStatus()
            ->map(fn(User $user) => $user->only(['id', 'name', 'icon_path']))
            ->all();
    }
}
