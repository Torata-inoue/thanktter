<?php

namespace App\Repository;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

abstract class Repository
{
    public function __construct(protected Model $model)
    {
        $this->model = new $model;
    }

    /**
     * @return Builder<Model>
     */
    protected function getQueryBuilder(): Builder
    {
        return $this->model->newQuery();
    }
}
