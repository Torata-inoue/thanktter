<?php

namespace App\Domains\Nominee;

use App\Domains\Repository;

/**
 * @extends Repository<Nominee>
 */
class NomineeRepository extends Repository
{
    public function __construct(Nominee $nominee)
    {
        parent::__construct($nominee);
    }
}
