<?php

namespace App\Http\API\V1\Requests\Comment;

use App\Http\BaseRequest;
use Illuminate\Contracts\Validation\Validator;

class PostRequest extends BaseRequest
{
    protected array $rules = [
        'text' => 'required|string|max:10',
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

    protected function prepareValidate(Validator $validator): void
    {
//        dd($validator);
    }
}
