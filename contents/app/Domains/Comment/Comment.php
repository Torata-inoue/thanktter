<?php

namespace App\Domains\Comment;

use App\Domains\Cache\CacheableModel;
use Carbon\Carbon;

/**
 * @property int $id
 * @property int $user_id
 * @property string $text
 * @property int $string
 * @property int $type
 * @property int $reply_to
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class Comment extends CacheableModel
{
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
}
