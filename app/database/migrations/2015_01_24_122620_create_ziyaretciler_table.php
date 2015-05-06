<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateZiyaretcilerTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('ziyaretciler', function($table) {
		$table->increments('id');
		$table->string('http_accept');
		$table->string('http_accept_encoding');
		$table->string('http_accept_language');
		$table->string('http_connection');
		$table->text('http_cookie');
		$table->string('http_host');
		$table->string('http_user_agent');
		$table->string('document_root');
		$table->string('http_client_ip');
		$table->string('remote_addr');
		$table->string('remote_port');
		$table->string('server_addr');
		$table->string('server_name');
		$table->string('server_admin');
		$table->string('server_port');
		$table->string('request_uri');
		$table->string('script_filename');
		$table->string('query_string');
		$table->string('script_uri');
		$table->string('script_url');
		$table->string('script_name');
		$table->string('server_protocol');
		$table->string('server_software');
		$table->string('request_method');
		$table->string('request_time_float');
		$table->string('request_time');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('ziyaretciler');
    }

}
