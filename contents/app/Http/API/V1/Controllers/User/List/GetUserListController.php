<?php

namespace App\Http\API\V1\Controllers\User\List;

use App\Http\BaseController;
use App\Library\Http\Response\JsonResponse;
use App\Service\User\ListService;

class GetUserListController extends BaseController
{
    public function getUserList(ListService $service): JsonResponse
    {
        return new JsonResponse($service->getUserList());
    }
}
