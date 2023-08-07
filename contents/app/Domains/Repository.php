<?php

namespace App\Domains;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * @template T of Model
 * @template TBuilder of Builder<T>
 */
abstract class Repository
{
    /**
     * @param T $model
     */
    public function __construct(protected Model $model)
    {
    }

    /**
     * @return TBuilder
     */
    protected function getQueryBuilder(): Builder
    {
        return $this->model->newQuery();
    }
}
