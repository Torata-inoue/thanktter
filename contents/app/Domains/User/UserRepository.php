<?php

namespace App\Domains\User;

use App\Domains\Cache\CacheableRepository;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

/**
 * @extends CacheableRepository<User, Builder<User>>
 */
class UserRepository extends CacheableRepository
{
    public function __construct(User $model)
    {
        parent::__construct($model);
    }

    /**
     * @param int[] $user_ids
     * @return Collection<int, User>
     */
    public function getByIds(array $user_ids): Collection
    {
        return $this->getQueryBuilder()
            ->whereIn('id', $user_ids)
            ->where('status', '=', User::STATUS_EXIST)
            ->get();
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

    public function save(User $user): bool
    {
        return $user->save();
    }
}
