<?php

namespace App\Library\Http\Response;

use Illuminate\Http\JsonResponse;

class JsonErrorResponse extends JsonResponse
{
    /**
     * @param int $code
     * @param array<string, string> $errors
     */
    public function __construct(int $code, array $errors)
    {
        parent::__construct(compact('code', 'errors'));
    }
}
