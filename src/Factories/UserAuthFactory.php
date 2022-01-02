<?php

namespace PanelSsh\Shared\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use PanelSsh\Shared\Models\UserAuthModel;

class UserAuthFactory extends Factory
{
    protected $model = UserAuthModel::class;

    public function definition()
    {
        return [
            'id_ext' => nanoid(),
            'email' => $this->faker->unique()->safeEmail(),
            'password' => Hash::make('password'),
            'is_active' => $this->faker->boolean(),
            'last_seen_at' => Carbon::now(),
            'last_login_at' => Carbon::now(),
            'email_verified_at' => Carbon::now(),
            'created_at' => Carbon::now(),
            'created_by' => [],
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (UserAuthModel $userAuth) {
            return $userAuth->profile()->create([
                'id_ext' => $userAuth->id_ext,
                'email' => $userAuth->email,
                'first_name' => $this->faker->firstName(),
                'last_name' => $this->faker->lastName(),
                'avatar_image' => $this->faker->imageUrl(200, 200),
                'created_at' => Carbon::now(),
                'created_by' => [],
            ]);
        });
    }
}
