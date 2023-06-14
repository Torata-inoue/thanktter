<?php

namespace App\Http\API\V1\Requests\Comment;

use App\Http\BaseRequest;

class PostRequest extends BaseRequest
{
    protected array $rules = [
        'text' => 'string|max:1000',
        'nomineeIds' => 'array|max:10',
        'nomineeIds.*' => 'required|int|min:0',
        'images' => 'array|max:4',
        'images.*' => 'string',
    ];

    protected array $formAttributes = [
        'text' => 'コメント本文',
        'nomineeIds' => '推薦者',
        'images' => '画像',
    ];
}
