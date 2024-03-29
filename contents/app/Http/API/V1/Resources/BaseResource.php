<?php

namespace App\Http\API\V1\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @template TResource
 */
abstract class BaseResource extends JsonResource
{
    public static $wrap = null;

    /**
     * @var TResource
     */
    public $resource;
}
