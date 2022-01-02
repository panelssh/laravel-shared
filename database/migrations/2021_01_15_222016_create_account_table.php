<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccountTable extends Migration
{
    public function up()
    {
        Schema::create('account', function (Blueprint $table) {
            $table->id();
            $table->char('id_ext', 21)->unique();
            $table->string('username')->index();
            $table->text('password');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->char('user_id_ext', 21)->nullable();
            $table->unsignedBigInteger('server_id');
            $table->char('server_id_ext', 21);
            $table->string('server_name');
            $table->string('server_slug');
            $table->unsignedInteger('type_id');
            $table->char('type_id_ext', 21);
            $table->string('type_name');
            $table->string('type_slug');
            $table->unsignedInteger('country_id');
            $table->char('country_id_ext', 21);
            $table->string('country_name');
            $table->string('country_slug');
            $table->string('city_name')->nullable();
            $table->json('metadata')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamp('expired_at')->index();
            $table->timestamp('created_at')->nullable();
            $table->json('created_by')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->json('updated_by')->nullable();

            $table->foreign('user_id')
                ->on('user_auth')
                ->references('id')
                ->restrictOnDelete();

            $table->foreign('server_id')
                ->on('server')
                ->references('id')
                ->restrictOnDelete();

            $table->foreign('type_id')
                ->on('server_type')
                ->references('id')
                ->restrictOnDelete();

            $table->foreign('country_id')
                ->on('m_country')
                ->references('id')
                ->restrictOnDelete();
        });
    }

    public function down()
    {
        Schema::dropIfExists('account');
    }
}
