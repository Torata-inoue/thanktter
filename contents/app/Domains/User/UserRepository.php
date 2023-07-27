<?php

namespace App\Domains\User;

use App\Domains\Cache\CacheableRepository;

/**
 * @extends CacheableRepository<User>
 */
class UserRepository extends CacheableRepository
{
    public function __construct(User $model)
    {
        parent::__construct($model);
    }
}
