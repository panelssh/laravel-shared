<?php

namespace PanelSsh\Shared\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use PanelSsh\Shared\Models\CountryModel;
use PanelSsh\Shared\Models\ServerModel;
use PanelSsh\Shared\Models\ServerTypeModel;

class ServerFactory extends Factory
{
    protected $model = ServerModel::class;

    public function definition()
    {
        /** @var ServerTypeModel $serverType */
        $serverType = ServerTypeModel::active()->inRandomOrder()->first();

        /** @var CountryModel $country */
        $country = CountryModel::query()->inRandomOrder()->first();

        return [
            'slug' => $this->faker->slug,
            'name' => "{$country->iso_3166_2} - {$country->name}",
            'ip_address' => $this->faker->ipv4,
            'username' => 'root',
            'password' => 'password',
            'port' => 22,
            'type_id' => $serverType->id,
            'type_id_ext' => $serverType->id_ext,
            'type_name' => $serverType->name,
            'type_slug' => $serverType->slug,
            'country_id' => $country->id,
            'country_id_ext' => $country->id_ext,
            'country_name' => $country->name,
            'country_slug' => $country->slug,
            'city_name' => $this->faker->city,
            'limit_daily' => $this->faker->numberBetween(30, 50),
            'limit_monthly' => $this->faker->numberBetween(1000, 1500),
            'limit_total' => $this->faker->numberBetween(20000, 30000),
            'active_day' => $this->faker->numberBetween(3, 5),
            'is_active' => $this->faker->boolean,
        ];
    }
}
