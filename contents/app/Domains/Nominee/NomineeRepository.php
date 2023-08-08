<?php

namespace App\Domains\Nominee;

use App\Domains\Repository;
use Illuminate\Database\Eloquent\Builder;

/**
 * @extends Repository<Nominee, Builder<Nominee>>
 */
class NomineeRepository extends Repository
{
    public function __construct(Nominee $nominee)
    {
        parent::__construct($nominee);
    }

    public function save(Nominee $nominee): bool
    {
        return $nominee->save();
    }
}
