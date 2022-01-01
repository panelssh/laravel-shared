<?php

namespace PanelSsh\Shared\Seeders;

use Illuminate\Database\Seeder;
use PanelSsh\Shared\Models\UserAuthModel;

class UserAuthSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        UserAuthModel::factory(100)->create();
    }
}
