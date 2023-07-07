<?php

namespace App\Http\API\V1\Requests\Auth;

use App\Http\BaseRequest;

class LoginRequest extends BaseRequest
{
    protected array $rules = [
        'email' => ['required', 'email'],
        'password' => ['required', 'min:6']
    ];

    protected array $formAttributes = [
        'email' => 'メールアドレス',
        'password' => 'パスワード'
    ];
}
