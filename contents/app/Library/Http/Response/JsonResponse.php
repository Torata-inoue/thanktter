<?php

namespace App\Library\Http\Response;

use Illuminate\Http\JsonResponse as BaseJsonResponse;
use Symfony\Component\HttpFoundation\Response;

class JsonResponse extends BaseJsonResponse
{
    public function __construct($data = null)
    {
        $response['data'] = $data;
        $response['code'] = Response::HTTP_OK;
        $response['errors'] = [];

        parent::__construct($response);
    }
}
