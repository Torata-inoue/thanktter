<?php

namespace App\Domains\User;

use App\Domains\Cache\CacheableRepository;
use Illuminate\Database\Eloquent\Collection;

/**
 * @extends CacheableRepository<User>
 */
class UserRepository extends CacheableRepository
{
    public function __construct(User $model)
    {
        parent::__construct($model);
    }

    /**
     * @return Collection<int, User>
     */
    public function getUsersByStatus(): Collection
    {
        return $this->getQueryBuilder()
            ->where('status', '=', User::STATUS_EXIST)
            ->get();
    }
}
