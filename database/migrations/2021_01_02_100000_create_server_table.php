<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServerTable extends Migration
{
    public function up()
    {
        Schema::create('server', function (Blueprint $table) {
            $table->id();
            $table->char('id_ext', 21)->unique();
            $table->string('slug')->index();
            $table->string('name');
            $table->text('description')->nullable();
            $table->longText('content')->nullable();
            $table->string('ip_address');
            $table->string('hostname')->nullable();
            $table->string('username')->default('root');
            $table->text('password');
            $table->tinyInteger('port')->default(22);
            $table->tinyInteger('status')
                ->default(0)
                ->comment('0: uncovered, 1: connected, 2: error');
            $table->unsignedInteger('type_id');
            $table->char('type_id_ext', 21);
            $table->string('type_name');
            $table->string('type_slug');
            $table->unsignedInteger('country_id');
            $table->char('country_id_ext', 21);
            $table->string('country_name');
            $table->string('country_slug');
            $table->string('city_name')->nullable();
            $table->integer('limit_daily');
            $table->integer('limit_monthly');
            $table->integer('limit_total');
            $table->integer('active_day');
            $table->text('payload');
            $table->boolean('is_active')->default(false);
            $table->timestamp('created_at')->nullable();
            $table->json('created_by')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->json('updated_by')->nullable();

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
        Schema::dropIfExists('server');
    }
}
