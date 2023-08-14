<?php

namespace App\Domains\Comment;

use App\Domains\Cache\CacheableModel;
use App\Domains\Comment\Image\CommentImage;
use App\Domains\User\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\RelationNotFoundException;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id
 * @property int $user_id
 * @property string $text
 * @property int $string
 * @property int $type
 * @property int $reply_to
 * @property User $user
 * @property Collection<int, Comment> $replies
 * @property Collection<int, User> $nominees
 * @property Collection<int, CommentImage> $images
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

    protected $visible = [
        'id', 'user_id', 'text', 'status', 'type', 'reply_to', 'created_at', 'updated_at',
        'user', 'replies', 'nominees', 'images'
    ];

    /**
     * @param $query
     * @return CommentBuilder
     */
    public function newEloquentBuilder($query): CommentBuilder
    {
        return new CommentBuilder($query);
    }

    /**
     * @return BelongsTo<User, Comment>
     */
    public function belongsToUser(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * @return Attribute<User, void>
     */
    public function user(): Attribute
    {
        return Attribute::make(
            get: function () {
                if (!$this->relationLoaded('belongsToUser')) {
                    throw new RelationNotFoundException();
                }
                return $this->belongsToUser;
            },
            set: fn (User $user) => $this->setRelation('belongsToUser', $user)
        );
    }

    /**
     * @return HasMany<Comment>
     */
    public function hasManyReplies(): HasMany
    {
        return $this->hasMany(Comment::class, 'reply_to');
    }

    /**
     * @return Attribute<Collection<int, Comment>, void>
     */
    public function replies(): Attribute
    {
        return Attribute::make(
            get: function () {
                if (!$this->relationLoaded('hasManyReplies')) {
                    throw new RelationNotFoundException();
                }
                return $this->hasManyReplies;
            },
            set: fn (Collection $replies) => $this->setRelation('hasManyReplies', $replies)
        );
    }

    /**
     * @return BelongsToMany<User>
     */
    public function belongsToManyNominees(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'nominees', 'comment_id', 'user_id');
    }

    /**
     * @return Attribute<Collection<int, User>, void>
     */
    public function nominees(): Attribute
    {
        return Attribute::make(
            get: function () {
                if (!$this->relationLoaded('belongsToManyNominees')) {
                    throw new RelationNotFoundException();
                }
                return $this->belongsToManyNominees;
            },
            set: fn (Collection $nominees) => $this->setRelation('belongsToManyNominees', $nominees)
        );
    }

    /**
     * @return HasMany<CommentImage>
     */
    public function hasManyImages(): HasMany
    {
        return $this->hasMany(CommentImage::class);
    }

    /**
     * @return Attribute<Collection<int, CommentImage>, void>
     */
    public function images(): Attribute
    {
        return Attribute::make(
            get: function () {
                if (!$this->relationLoaded('hasManyImages')) {
                    throw new RelationNotFoundException();
                }
                return $this->hasManyImages;
            },
            set: fn (Collection $images) => $this->setRelation('hasManyImages', $images)
        );
    }
}
