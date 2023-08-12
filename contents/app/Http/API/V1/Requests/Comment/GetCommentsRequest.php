<?php

namespace App\Http\API\V1\Requests\Comment;

use App\Http\API\V1\Requests\BaseRequest;

class GetCommentsRequest extends BaseRequest
{
    protected array $rules = [
        'page' => ['required', 'int', 'min:1']
    ];
}
