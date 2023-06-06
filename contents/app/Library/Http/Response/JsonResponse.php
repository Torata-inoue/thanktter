<?php

namespace App\Library\Http\Response;

use Illuminate\Http\JsonResponse as BaseJsonResponse;
use Symfony\Component\HttpFoundation\Response;

class JsonResponse extends BaseJsonResponse
{
    public function __construct($data = null)
    {
        $data['code'] = Response::HTTP_OK;
        $data['errors'] = [];

        parent::__construct($data);
    }
}
