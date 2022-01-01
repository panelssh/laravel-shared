<?php

namespace PanelSsh\Shared\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use PanelSsh\Core\Traits\HasNanoid;

/**
 * @property int                $id
 * @property UserAuthModel      $auth
 * @property string             $email
 * @property string             $first_name
 * @property string|null        $last_name
 * @property-read string        $full_name
 * @property string|null        $avatar_image
 * @property-read string        $avatar_image_url
 * @property Carbon|string|null $created_at
 * @property object|null        $created_by
 * @property Carbon|string|null $updated_at
 * @property object|null        $updated_by
 */
class UserProfileModel extends Model
{
    use HasNanoid;

    protected $table = 'user_profile';

    protected $fillable = [
        'id_ext',
        'email',
        'first_name',
        'last_name',
        'avatar_image',
        'created_by',
        'updated_by',
    ];

    protected $casts = [
        'created_by' => 'object',
        'updated_by' => 'object',
    ];

    public function auth()
    {
        return $this->hasOne(UserAuthModel::class, 'id');
    }

    public function accounts()
    {
        return $this->hasMany(AccountModel::class, 'user_id');
    }

    public function getFullNameAttribute()
    {
        return is_null($this->last_name) ? $this->first_name : $this->first_name . ' ' . $this->last_name;
    }

    public function getAvatarImageUrlAttribute()
    {
        return Storage::url($this->avatar_image);
    }
}
