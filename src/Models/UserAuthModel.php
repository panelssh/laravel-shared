<?php

namespace PanelSsh\Shared\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use PanelSsh\Core\Traits\HasNanoid;
use PanelSsh\Core\Traits\HasStatus;
use PanelSsh\Shared\Factories\UserAuthFactory;

/**
 * @property int                $id
 * @property UserProfileModel   $profile
 * @property string             $email
 * @property string             $password
 * @property Carbon|string|null $last_seen_at
 * @property Carbon|string|null $last_login_at
 * @property Carbon|string|null $email_verified_at
 * @property Carbon|string|null $created_at
 * @property array|object|null  $created_by
 * @property Carbon|string|null $updated_at
 * @property array|object|null  $updated_by
 */
class UserAuthModel extends Model
{
    use HasFactory;
    use HasNanoid;
    use HasStatus;

    protected $table = 'user_auth';

    protected $with = ['profile'];

    protected $fillable = [
        'id_ext',
        'email',
        'password',
        'last_seen_at',
        'last_login_at',
        'email_verified_at',
        'created_by',
        'updated_by',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'created_by' => 'object',
        'updated_by' => 'object',
    ];

    protected static function newFactory()
    {
        return UserAuthFactory::new();
    }

    public function profile()
    {
        return $this->hasOne(UserProfileModel::class, 'id');
    }

    public function accounts()
    {
        return $this->hasMany(AccountModel::class, 'user_id');
    }
}
