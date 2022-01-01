<?php

namespace PanelSsh\Shared\Seeders;

use Illuminate\Database\Seeder;
use PanelSsh\Shared\Models\ServerModel;

class ServerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ServerModel::factory(100)->create();
    }
}
