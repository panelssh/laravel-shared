<?php

namespace PanelSsh\Shared\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Crypt;
use PanelSsh\Core\Traits\HasNanoid;
use PanelSsh\Core\Traits\HasStatus;
use PanelSsh\Shared\Factories\AccountFactory;

/**
 * @property int          $id
 * @property string       $username
 * @property string          $password
 * @property int             $auth
 * @property int             $profile
 * @property int             $user_id
 * @property int             $user_id_ext
 * @property ServerModel     $server
 * @property int             $server_id
 * @property int             $server_id_ext
 * @property string|null     $server_name
 * @property string|null     $server_slug
 * @property ServerTypeModel $type
 * @property int             $type_id
 * @property int             $type_id_ext
 * @property string          $type_name
 * @property string          $type_slug
 * @property CountryModel    $country
 * @property int             $country_id
 * @property int             $country_id_ext
 * @property string          $country_name
 * @property string          $country_slug
 * @property string          $city_name
 * @property object|null        $metadata
 * @property Carbon|string      $expired_at
 * @property Carbon|string|null $created_at
 * @property object|null        $created_by
 * @property Carbon|string|null $updated_at
 * @property object|null        $updated_by
 */
class AccountModel extends Model
{
    use HasFactory;
    use HasNanoid;
    use HasStatus;

    protected $table = 'account';

    protected $fillable = [
        'id_ext',
        'username',
        'password',
        'user_id',
        'user_id_ext',
        'server_id',
        'server_id_ext',
        'server_name',
        'server_slug',
        'type_id',
        'type_id_ext',
        'type_name',
        'type_slug',
        'country_id',
        'country_id_ext',
        'country_name',
        'country_slug',
        'city_name',
        'metadata',
        'expired_at',
        'created_by',
        'updated_by',
    ];

    protected $hidden = [
        'password',
        'metadata',
    ];

    protected $casts = [
        'metadata' => 'object',
        'created_by' => 'object',
        'updated_by' => 'object',
    ];

    protected static function newFactory()
    {
        return AccountFactory::new();
    }

    public function server()
    {
        return $this->belongsTo(ServerModel::class, 'server_id');
    }

    public function type()
    {
        return $this->belongsTo(ServerTypeModel::class, 'type_id');
    }

    public function country()
    {
        return $this->belongsTo(CountryModel::class, 'country_id');
    }

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Crypt::encrypt($value);
    }

    public function getPasswordAttribute($value)
    {
        return Crypt::decrypt($value);
    }
}
