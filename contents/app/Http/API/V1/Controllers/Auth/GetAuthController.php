<?php

namespace App\Http\API\V1\Controllers\Auth;

use App\Http\BaseController;
use App\Library\Http\Response\JsonResponse;
use Illuminate\Auth\AuthManager;

class GetAuthController extends BaseController
{
    public function __construct(private readonly AuthManager $auth)
    {
    }

    public function getAuth(): JsonResponse
    {
        $data = ['user' => $this->auth->user()];
        return new JsonResponse(compact('data'));
    }
}
