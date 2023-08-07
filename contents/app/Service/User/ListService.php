<?php

namespace App\Service\User;

use App\Domains\User\User;
use App\Domains\User\UserRepository;
use Illuminate\Database\Eloquent\Collection;

readonly class ListService
{
    public function __construct(private UserRepository $userRepository)
    {
    }

    /**
     * @return Collection<int, User>
     */
    public function getUserList(): Collection
    {
        return $this->userRepository->getUsersByStatus();
    }
}
