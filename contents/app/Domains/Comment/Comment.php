<?php

namespace App\Domains\Comment;

use App\Domains\Cache\CacheableModel;
use App\Domains\User\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @property int $id
 * @property int $user_id
 * @property string $text
 * @property int $string
 * @property int $type
 * @property int $reply_to
 * @property User|null $user
 * @property Collection<int, Comment>|null $replies
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class Comment extends CacheableModel
{
    use HasFactory;

    const STATUS_DELETED = 0; //削除コメント
    const STATUS_EXIST   = 1; //存在するコメント

    const TYPE_DEFAULT  = 1; //通常コメント
    const TYPE_BIRTHDAY = 2; //誕生日コメント

    const NOT_REPLY_COMMENT = 0;  //返信じゃないコメント

    /**
     * @var array<int, string>
     */
    protected $guarded = [
        'id'
    ];

    public function setUserRelation(User $user): void
    {
        $this->setRelation('user', $user);
    }

    /**
     * @param Collection<int, Comment> $replies
     * @return void
     */
    public function setRepliesRelation(Collection $replies): void
    {
        $this->setRelation('replies', $replies);
    }
}
