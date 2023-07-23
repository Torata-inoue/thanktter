<?php

namespace App\Domains;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * @template T of Model
 */
abstract class Repository
{
    /**
     * @param Model $model
     */
    public function __construct(protected Model $model)
    {
    }

    /**
     * @return Builder<T>
     */
    protected function getQueryBuilder(): Builder
    {
        return $this->model->newQuery();
    }
}
