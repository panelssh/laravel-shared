<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateUserProfileTable extends Migration
{
    public function up()
    {
        Schema::create('user_profile', function (Blueprint $table) {
            $table->foreignId('id');
            $table->char('id_ext', 21)->unique();
            $table->string('email')->unique();
            $table->string('first_name');
            $table->string('last_name')->nullable();
            $table->string('avatar_image')->nullable();
            $table->timestamp('created_at')->nullable();
            $table->json('created_by')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->json('updated_by')->nullable();

            $table->foreign('id')
                ->on('user_auth')
                ->references('id')
                ->restrictOnDelete();
        });

        DB::table('user_profile')->insertOrIgnore([
            [
                'id' => 1,
                'id_ext' => '290297170731061052201',
                'email' => 'admin@admin.com',
                'first_name' => 'Admin',
                'created_at' => '2020-01-01 00:00:00',
                'updated_at' => '2020-01-01 00:00:00',
            ],
            [
                'id' => 2,
                'id_ext' => '453781977981869699626',
                'email' => 'demo@demo.com',
                'first_name' => 'Demo',
                'created_at' => '2020-01-01 00:00:00',
                'updated_at' => '2020-01-01 00:00:00',
            ],
        ]);
    }

    public function down()
    {
        Schema::dropIfExists('user_auth');
    }
}
