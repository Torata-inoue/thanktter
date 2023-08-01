<?php

namespace App\Http\API\V1\Controllers\Auth;

use App\Http\API\V1\Requests\Auth\LoginRequest;
use App\Http\BaseController;
use App\Library\Http\Response\JsonResponse;
use Illuminate\Auth\AuthManager;
use Illuminate\Auth\AuthenticationException;

class LoginController extends BaseController
{
    public function __construct(private readonly AuthManager $auth)
    {
    }

    /**
     * @param LoginRequest $request
     * @return JsonResponse
     * @throws AuthenticationException
     */
    public function __invoke(LoginRequest $request): JsonResponse
    {
        $data = $request->getValidData();

        if ($this->auth->guard()->attempt($data)) {
            $request->session()->regenerate();

            return new JsonResponse(['user' => $this->auth->user()]);
        }

        throw new AuthenticationException();
    }
}
