<?php

namespace App\Service;

use App\Domains\User\User;

readonly class BaseService
{
    protected User $auth;

    public function __construct()
    {
        $this->auth = app(User::class);
    }
}
