<?php

namespace App\Domains\Nominee;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $comment_id
 * @property int $user_id
 */
class Nominee extends Model
{
    /**
     * @var array<int, string>
     */
    protected $guarded = ['id'];
}
