<?php

namespace App\Http\API\V1\Controllers\Auth;

use App\Http\BaseController;
use App\Library\Http\Response\JsonResponse;
use Illuminate\Auth\AuthManager;
use Illuminate\Http\Request;

class LogoutController extends BaseController
{
    public function __construct(private readonly AuthManager $authManager)
    {
    }

    public function __invoke(Request $request): JsonResponse
    {
        if ($this->authManager->guard()->guest()) {
            return new JsonResponse();
        }

        $this->authManager->guard()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return new JsonResponse();
    }
}
