<?php

namespace App\Domains\Nominee;

use App\Domains\User\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $comment_id
 * @property int $user_id
 * @property User|null $user
 */
class Nominee extends Model
{
    use HasFactory;

    public $timestamps = false;

    /**
     * @var array<int, string>
     */
    protected $guarded = ['id'];

    public function setUserRelation(User $user): void
    {
        $this->setRelation('user', $user);
    }
}
