<?php

namespace App\Http\API\V1\Requests\Reply;

use App\Http\API\V1\Requests\BaseRequest;

class PostReplyRequest extends BaseRequest
{
    protected array $rules = [
        'commendId' => ['required', 'int'],
        'text' => ['required', 'string', 'max:500'],
    ];

    protected array $formAttributes = [
        'text' => '返信本文'
    ];
}
