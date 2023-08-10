<?php

namespace App\Http\API\V1\Controllers\User\List;

use App\Http\API\V1\Controllers\BaseController;
use App\Http\API\V1\Resources\User\UserResource;
use App\Library\Http\Response\JsonResponse;
use App\Service\User\ListService;

class GetUserListController extends BaseController
{
    public function getUserList(ListService $service): JsonResponse
    {
        $userList = $service->getUserList();

        return new JsonResponse(UserResource::collection($userList));
    }
}
