<?php

namespace App\Service;

use App\Domains\User\User;
use Illuminate\Auth\AuthManager;

readonly class BaseService
{
    protected User $auth;

    public function __construct()
    {
        $this->auth = app(AuthManager::class)->user();
    }
}
