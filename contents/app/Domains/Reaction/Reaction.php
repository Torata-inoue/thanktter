<?php

namespace App\Domains\Reaction;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $comment_id
 * @property int $user_id
 * @property int $target_id
 * @property int $type
 * @property Carbon $created_at
 */
class Reaction extends Model
{
    const UPDATED_AT = null;

    /**
     * @var array<int, string>
     */
    protected $guarded = ['id'];
}
