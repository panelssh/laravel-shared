<?php

namespace PanelSsh\Shared\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use PanelSsh\Core\Traits\HasNanoid;
use PanelSsh\Core\Traits\HasStatus;
use PanelSsh\Shared\Enums\TunnelServiceEnum;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * @property int                $id
 * @property string             $slug
 * @property string             $name
 * @property int                $service
 * @property string             $icon
 * @property-read string        $icon_url
 * @property string             $description
 * @property string             $content
 * @property string             $command_create
 * @property string             $command_renew
 * @property string             $command_change_password
 * @property string             $command_delete
 * @property array|object|null  $secrets
 * @property array|object|null  $services
 * @property array|object|null  $properties
 * @property Carbon|string|null $created_at
 * @property object|null        $created_by
 * @property Carbon|string|null $updated_at
 * @property object|null        $updated_by
 * @property ServerModel[]      $servers
 * @property int                $servers_count
 * @property-read string        $view
 * @property-read array         $validations
 */
class ServerTypeModel extends Model
{
    use HasNanoid;
    use HasStatus;

    protected $table = 'server_type';

    protected $fillable = [
        'id_ext',
        'slug',
        'name',
        'icon',
        'service',
        'description',
        'content',
        'command_create',
        'command_renew',
        'command_change_password',
        'command_delete',
        'secrets',
        'services',
        'properties',
        'created_by',
        'updated_by',
    ];

    protected $hidden = [
        'command_create',
        'command_renew',
        'command_change_password',
        'command_delete',
        'secrets',
    ];

    protected $casts = [
        'secrets' => 'array',
        'services' => 'array',
        'properties' => 'array',
        'created_by' => 'object',
        'updated_by' => 'object',
    ];

    public static function getServiceType()
    {
        return collect([
            [
                'id' => TunnelServiceEnum::SSH_TUNNEL,
                'name' => 'SSH Tunnel',
                'view' => 'secure-shell',
                'validations' => [
                    'username' => ['required', 'string', 'min:4', 'max:10'],
                    'password' => ['required', 'string', 'min:1'],
                ],
            ],
            [
                'id' => TunnelServiceEnum::OPENVPN,
                'name' => 'OpenVPN',
                'view' => 'openvpn',
                'validations' => [
                    'username' => ['required', 'string', 'min:4', 'max:10'],
                    'password' => ['required', 'string', 'min:1'],
                ],
            ],
            [
                'id' => TunnelServiceEnum::L2TP_IPSEC,
                'name' => 'L2TP/IPSec',
                'view' => 'l2tp-ipsec',
                'validations' => [
                    'username' => ['required', 'string', 'min:4', 'max:10'],
                    'password' => ['required', 'string', 'min:1'],
                ],
            ],
            [
                'id' => TunnelServiceEnum::WIREGUARD,
                'name' => 'Wireguard',
                'view' => 'wireguard',
                'validations' => [
                    'username' => ['required', 'string', 'min:4', 'max:10'],
                ],
            ],
            [
                'id' => TunnelServiceEnum::SHADOWSOCKS,
                'name' => 'Shadowsocks',
                'view' => 'shadowsocks',
                'validations' => [
                    'password' => ['required', 'string', 'min:1', 'max:10'],
                ],
            ],
            [
                'id' => TunnelServiceEnum::V2RAY_VMESS,
                'name' => 'V2Ray VMess',
                'view' => 'v2ray-vmess',
                'validations' => [
                    'username' => ['required', 'string', 'min:4', 'max:10'],
                ],
            ],
            [
                'id' => TunnelServiceEnum::TROJAN,
                'name' => 'Trojan',
                'view' => 'trojan',
                'validations' => [
                    'password' => ['required', 'string', 'min:4', 'max:10'],
                ],
            ],
        ]);
    }

    public function servers()
    {
        return $this->hasMany(ServerModel::class, 'type_id');
    }

    public function getServersCountAttribute()
    {
        return $this->servers()->count();
    }

    public function setSecretsAttribute($value)
    {
        if (isset($value)) {
            $values = collect(array_values($value))->map(function ($item) {
                return [
                    'key' => $item['key'],
                    'value' => $item['value'],
                ];
            });

            $this->attributes['secrets'] = $this->asJson($values->toArray());
        }
    }

    public function setServicesAttribute($value)
    {
        if (isset($value)) {
            $values = collect(array_values($value))->map(function ($item) {
                return [
                    'name' => $item['name'],
                    'ports' => $item['ports'],
                ];
            });

            $this->attributes['services'] = $this->asJson($values->toArray());
        }
    }

    public function setPropertiesAttribute($value)
    {
        if (isset($value)) {
            $values = collect(array_values($value))->map(function ($item) {
                return [
                    'name' => $item['name'],
                    'description' => $item['description'],
                ];
            });

            $this->attributes['properties'] = $this->asJson($values->toArray());
        }
    }

    public function getViewAttribute()
    {
        if (self::getServiceType()->where('id', $this->service)->count() === 0) {
            throw new NotFoundHttpException;
        }

        return self::getServiceType()->where('id', $this->service)->pluck('view')[0];
    }

    public function getValidationsAttribute()
    {
        if (self::getServiceType()->where('id', $this->service)->count() === 0) {
            throw new NotFoundHttpException;
        }

        return self::getServiceType()->where('id', $this->service)->pluck('validations')[0];
    }

    public function getIconUrlAttribute()
    {
        return Storage::url($this->icon);
    }
}
