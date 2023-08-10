<?php

namespace App\Http\API\V1\Controllers\Auth;

use App\Http\API\V1\Controllers\BaseController;
use App\Http\API\V1\Resources\User\UserResource;
use App\Library\Http\Response\JsonResponse;
use Illuminate\Auth\AuthManager;

class GetAuthController extends BaseController
{
    public function __construct(private readonly AuthManager $auth)
    {
    }

    public function getAuth(): JsonResponse
    {
        return new JsonResponse(new UserResource($this->auth->user()));
    }
}
