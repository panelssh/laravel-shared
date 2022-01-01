<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateUserAuthTable extends Migration
{
    public function up()
    {
        Schema::create('user_auth', function (Blueprint $table) {
            $table->id();
            $table->char('id_ext', 21)->unique();
            $table->string('email')->unique();
            $table->string('password');
            $table->boolean('is_active')->default(false);
            $table->timestamp('last_seen_at')->nullable();
            $table->timestamp('last_login_at')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->timestamp('created_at')->nullable();
            $table->json('created_by')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->json('updated_by')->nullable();
        });

        DB::table('user_auth')->insertOrIgnore([
            [
                'id' => 1,
                'id_ext' => '290297170731061052201',
                'email' => 'admin@admin.com',
                'password' => '$2y$10$m4FxZRWN2Qau1xH5QUQSHOuBcknfsj7h.xBQXiIIRHz3mgtcc/0ca', // admin123
                'is_active' => true,
                'email_verified_at' => '2020-01-01 00:00:00',
                'created_at' => '2020-01-01 00:00:00',
                'updated_at' => '2020-01-01 00:00:00',
            ],
            [
                'id' => 2,
                'id_ext' => '453781977981869699626',
                'email' => 'demo@demo.com',
                'password' => '$2y$10$cJ3doSdfhByGrJLRZfGyDeS4tPpArRp5c/f1gA6Q/AFO/NKv3vYDm', // demo1234
                'is_active' => true,
                'email_verified_at' => '2020-01-01 00:00:00',
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
