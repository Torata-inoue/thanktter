<?php

namespace App\Http\API\V1\Requests\Reaction;

use App\Http\API\V1\Requests\BaseRequest;

class PostRequest extends BaseRequest
{
    protected array $rules = [
        'commentId' => ['required', 'int'],
        'userId' => ['required', 'int'],
        'type' => ['required', 'int'],
    ];
}
