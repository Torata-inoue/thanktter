<?php

namespace App\Library\ReactResponse;

readonly abstract class BaseResponse implements \JsonSerializable
{
    /**
     * @return array<mixed, mixed>
     */
    abstract public function jsonSerialize(): array;
}
