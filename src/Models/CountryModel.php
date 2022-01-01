<?php

namespace PanelSsh\Shared\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use PanelSsh\Core\Traits\HasNanoid;
use PanelSsh\Core\Traits\HasStatus;

/**
 * @property int                $id
 * @property string             $slug
 * @property string             $name
 * @property string             $region
 * @property string             $sub_region
 * @property string             $iso_3166_2
 * @property string             $iso_3166_3
 * @property-read string        $flag_url
 * @property double             $latitude
 * @property double             $longitude
 * @property Carbon|string|null $created_at
 * @property object|null        $created_by
 * @property Carbon|string|null $updated_at
 * @property object|null        $updated_by
 * @property ServerModel[]      $servers
 * @property AccountModel[]     $accounts
 */
class CountryModel extends Model
{
    use HasNanoid;
    use HasStatus;

    protected $table = 'm_country';

    protected $casts = [
        'created_by' => 'object',
        'updated_by' => 'object',
    ];

    public function servers()
    {
        return $this->hasMany(ServerModel::class, 'country_id');
    }

    public function accounts()
    {
        return $this->hasMany(AccountModel::class, 'country_id');
    }

    public function getFlagUrlAttribute()
    {
        return sprintf('//flagcdn.com/%s.svg', strtolower($this->iso_3166_2));
    }
}
