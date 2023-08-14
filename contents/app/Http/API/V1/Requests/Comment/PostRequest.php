<?php

namespace App\Http\API\V1\Requests\Comment;

use App\Http\API\V1\Requests\BaseRequest;

class PostRequest extends BaseRequest
{
    protected array $rules = [
        'text' => ['required', 'string', 'max:1000'],
        'nomineeIds' => ['required', 'array', 'max:10'],
        'nomineeIds.*' => ['required', 'int', 'min:0'],
        'images' => ['array', 'max:4'],
        'images.*' => ['image'],
    ];

    protected array $formAttributes = [
        'text' => 'コメント本文',
        'nomineeIds' => '推薦者',
        'images' => '画像',
        'images.0' => '画像',
        'images.1' => '画像',
        'images.2' => '画像',
        'images.3' => '画像',
    ];
}
