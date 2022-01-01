<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateServerTypeTable extends Migration
{
    public function up()
    {
        Schema::create('server_type', function (Blueprint $table) {
            $table->increments('id');
            $table->char('id_ext', 21)->unique();
            $table->string('slug')->unique();
            $table->string('name');
            $table->string('icon')->nullable();
            $table->tinyInteger('service')
                ->comment('1: SSH Tunnel, 2: OpenVPN, 3: L2TP/IPSec, 4: Wireguard, 5: Shadowsocks, 6: V2Ray VMess, 7: Trojan');
            $table->text('description')->nullable();
            $table->text('meta_description')->nullable();
            $table->text('command_create');
            $table->text('command_renew');
            $table->text('command_change_password');
            $table->text('command_delete');
            $table->json('secrets')->nullable();
            $table->json('services')->nullable();
            $table->json('properties')->nullable();
            $table->boolean('is_active')->default(false);
            $table->timestamp('created_at')->nullable();
            $table->json('created_by')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->json('updated_by')->nullable();
        });

        DB::table('server_type')->insertOrIgnore([
            [
                'id' => 1,
                'id_ext' => 1,
                'slug' => 'secure-shell',
                'name' => 'SSH Tunnel',
                'service' => 1,
                'icon' => 'https://via.placeholder.com/250x250',
                'command_create' => 'useradd -e [expired_at] [username] -s /bin/false -M;{ echo [password]; echo [password]; } | passwd [username];',
                'command_renew' => 'usermod -e [expired_at] [username];',
                'command_change_password' => '{ echo [password]; echo [password]; } | passwd [username];',
                'command_delete' => 'userdel -r [username];',
                'secrets' => json_encode([]),
                'services' => json_encode([]),
                'properties' => json_encode([]),
                'is_active' => true,
                'created_at' => '2021-01-01 00:00:00',
            ],
            [
                'id' => 2,
                'id_ext' => 2,
                'slug' => 'openvpn',
                'name' => 'OpenVPN',
                'service' => 2,
                'icon' => 'https://via.placeholder.com/250x250',
                'command_create' => 'exit',
                'command_renew' => 'exit',
                'command_change_password' => 'exit',
                'command_delete' => 'exit',
                'secrets' => json_encode([]),
                'services' => json_encode([]),
                'properties' => json_encode([]),
                'is_active' => true,
                'created_at' => '2021-01-01 00:00:00',
            ],
            [
                'id' => 3,
                'id_ext' => 3,
                'slug' => 'l2tp-ipsec',
                'name' => 'L2TP/IPSec',
                'service' => 3,
                'icon' => 'https://via.placeholder.com/250x250',
                'command_create' => 'exit',
                'command_renew' => 'exit',
                'command_change_password' => 'exit',
                'command_delete' => 'exit',
                'secrets' => json_encode([]),
                'services' => json_encode([]),
                'properties' => json_encode([]),
                'is_active' => true,
                'created_at' => '2021-01-01 00:00:00',
            ],
            [
                'id' => 4,
                'id_ext' => 4,
                'slug' => 'wireguard',
                'name' => 'Wireguard',
                'service' => 4,
                'icon' => 'https://via.placeholder.com/250x250',
                'command_create' => 'exit',
                'command_renew' => 'exit',
                'command_change_password' => 'exit',
                'command_delete' => 'exit',
                'secrets' => json_encode([]),
                'services' => json_encode([]),
                'properties' => json_encode([]),
                'is_active' => true,
                'created_at' => '2021-01-01 00:00:00',
            ],
            [
                'id' => 5,
                'id_ext' => 5,
                'slug' => 'shadowsocks',
                'name' => 'Shadowsocks',
                'service' => 5,
                'icon' => 'https://via.placeholder.com/250x250',
                'command_create' => 'exit',
                'command_renew' => 'exit',
                'command_change_password' => 'exit',
                'command_delete' => 'exit',
                'secrets' => json_encode([]),
                'services' => json_encode([]),
                'properties' => json_encode([]),
                'is_active' => true,
                'created_at' => '2021-01-01 00:00:00',
            ],
            [
                'id' => 6,
                'id_ext' => 6,
                'slug' => 'v2ray-vmess',
                'name' => 'V2Ray/VMess',
                'service' => 6,
                'icon' => 'https://via.placeholder.com/250x250',
                'command_create' => 'exit',
                'command_renew' => 'exit',
                'command_change_password' => 'exit',
                'command_delete' => 'exit',
                'secrets' => json_encode([]),
                'services' => json_encode([]),
                'properties' => json_encode([]),
                'is_active' => true,
                'created_at' => '2021-01-01 00:00:00',
            ],
            [
                'id' => 7,
                'id_ext' => 7,
                'slug' => 'trojan',
                'name' => 'Trojan',
                'service' => 7,
                'icon' => 'https://via.placeholder.com/250x250',
                'command_create' => 'exit',
                'command_renew' => 'exit',
                'command_change_password' => 'exit',
                'command_delete' => 'exit',
                'secrets' => json_encode([]),
                'services' => json_encode([]),
                'properties' => json_encode([]),
                'is_active' => true,
                'created_at' => '2021-01-01 00:00:00',
            ],
        ]);
    }

    public function down()
    {
        Schema::dropIfExists('server_type');
    }
}
