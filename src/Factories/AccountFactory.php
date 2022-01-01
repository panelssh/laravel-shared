<?php

namespace PanelSsh\Shared\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;
use PanelSsh\Shared\Models\AccountModel;
use PanelSsh\Shared\Models\CountryModel;
use PanelSsh\Shared\Models\ServerModel;
use PanelSsh\Shared\Models\ServerTypeModel;

class AccountFactory extends Factory
{
    protected $model = AccountModel::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        /** @var ServerModel $server */
        $server = ServerModel::active()->inRandomOrder()->first();

        return [
            'username' => $this->faker->userName,
            'password' => 'password',
            'server_id' => $server->id,
            'server_id_ext' => $server->id_ext,
            'server_name' => $server->name,
            'server_slug' => $server->slug,
            'type_id' => $server->type_id,
            'type_id_ext' => $server->type_id_ext,
            'type_name' => $server->type_name,
            'type_slug' => $server->type_slug,
            'country_id' => $server->country_id,
            'country_id_ext' => $server->country_id_ext,
            'country_name' => $server->country_name,
            'country_slug' => $server->country_slug,
            'city_name' => $server->city_name,
            'expired_at' => $expiredAt = $this->faker->dateTimeBetween('-1 years', '+1 years'),
            'created_at' => Carbon::parse($expiredAt)->subDays(3),
            'created_by' => [],
            'updated_at' => Carbon::parse($expiredAt)->subDays(1),
            'updated_by' => [],
            'is_active' => Carbon::parse($expiredAt)->gte(Carbon::now()),
        ];
    }
}
