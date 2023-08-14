<?php

namespace App\Domains\Comment\Image;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $comment_id
 * @property int $order
 * @property string $name
 * @property int $status
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class CommentImage extends Model
{
    const STATUS_DELETED = 0;
    const STATUS_EXIST   = 1;

    /**
     * @var array<int, string>
     */
    protected $guarded = [
        'id'
    ];

    public function getUrl(): string
    {
        return asset("storage/images/common/{$this->name}");
    }
}
