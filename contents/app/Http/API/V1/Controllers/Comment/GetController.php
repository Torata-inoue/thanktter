<?php

namespace App\Http\API\V1\Controllers\Comment;

use App\Http\API\V1\Controllers\BaseController;
use App\Http\API\V1\Requests\Comment\GetCommentsRequest;
use App\Http\API\V1\Resources\Comment\CommentResource;
use App\Library\Http\Response\JsonResponse;
use App\Service\Comment\GetCommentsService;

class GetController extends BaseController
{
    public function getComments(GetCommentsRequest $request, GetCommentsService $service): JsonResponse
    {
        $page = $request->integer('page');
        $list = $service->getList($page);

        return new JsonResponse(CommentResource::collection($list));
    }
}
