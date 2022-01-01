<?php

namespace PanelSsh\Shared\Seeders;

use Illuminate\Database\Seeder;
use PanelSsh\Shared\Models\AccountModel;

class AccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        AccountModel::factory(100)->create();
    }
}
