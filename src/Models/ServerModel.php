<?php

namespace PanelSsh\Shared\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Crypt;
use PanelSsh\Core\Traits\HasNanoid;
use PanelSsh\Core\Traits\HasStatus;
use PanelSsh\Shared\Factories\ServerFactory;

/**
 * @property int                $id
 * @property string          $slug
 * @property string          $name
 * @property string          $description
 * @property string          $content
 * @property string          $ip_address
 * @property string          $hostname
 * @property string          $username
 * @property string          $password
 * @property int             $port
 * @property int             $status
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
 * @property int                $limit_daily
 * @property int                $limit_monthly
 * @property int                $limit_total
 * @property int                $active_day
 * @property string             $payload
 * @property Carbon|string|null $created_at
 * @property object|null        $created_by
 * @property Carbon|string|null $updated_at
 * @property object|null        $updated_by
 * @property AccountModel[]     $accounts
 */
class ServerModel extends Model
{
    use HasFactory;
    use HasNanoid;
    use HasStatus;

    protected $table = 'server';

    protected $fillable = [
        'id_ext',
        'slug',
        'name',
        'description',
        'content',
        'ip_address',
        'hostname',
        'username',
        'password',
        'port',
        'status',
        'type_id',
        'type_id_ext',
        'type_name',
        'type_slug',
        'country_id',
        'country_id_ext',
        'country_name',
        'country_slug',
        'city_name',
        'limit_daily',
        'limit_monthly',
        'limit_total',
        'active_day',
        'payload',
        'created_by',
        'updated_by',
    ];

    protected $hidden = [
        'password',
    ];

    protected $casts = [
        'created_by' => 'object',
        'updated_by' => 'object',
    ];

    protected static function newFactory()
    {
        return ServerFactory::new();
    }

    public function type()
    {
        return $this->belongsTo(ServerTypeModel::class, 'type_id');
    }

    public function country()
    {
        return $this->belongsTo(CountryModel::class, 'country_id');
    }

    public function accounts()
    {
        return $this->hasMany(AccountModel::class, 'server_id');
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
