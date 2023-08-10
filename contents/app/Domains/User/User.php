<?php

namespace App\Domains\User;

use App\Domains\Cache\CacheableModel;
use Carbon\Carbon;
use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\MustVerifyEmail;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

/**
 * @property int $id
 * @property string $name
 * @property string $email
 * @property int $department_id
 * @property int $occupation_id
 * @property string $join_date
 * @property string $birthday
 * @property string $icon_path
 * @property string $password
 * @property string $comment
 * @property string $chatwork_id
 * @property int $permission
 * @property int $status
 * @property int $stamina
 * @property Carbon $last_login
 * @property int $rank
// * @property string $remember_token
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class User extends CacheableModel implements
    AuthenticatableContract,
    AuthorizableContract,
    CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword, MustVerifyEmail;
    use HasApiTokens, HasFactory, Notifiable;

    const PERMISSION_USER = 1;
    const PERMISSION_ADMIN = 2;

    const STATUS_DELETED = 0;
    const STATUS_EXIST = 1;

    /**
     * @var array<int, string>
     */
    protected $guarded = [
        'id'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function isAdmin(): bool
    {
        return $this->permission >= self::PERMISSION_ADMIN;
    }
}
