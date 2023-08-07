<?php

namespace App\Http\API\V1\Resources;

use App\Library\Http\Response\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @template TResource
 */
class BaseResource extends JsonResource
{
    public static $wrap = null;

    /**
     * @var TResource
     */
    public $resource;

    public function toJsonResponse(): JsonResponse
    {
        return new JsonResponse($this->toArray(request()));
    }
}
