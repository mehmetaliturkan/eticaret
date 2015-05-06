<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSatilanlarTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('satilanlar', function($table) {
            $table->increments('id');
            $table->integer('users_id');
            $table->string('ip');
            $table->integer('satilanlardurum_id');
            $table->integer('teslimatadresim_id');
            $table->integer('odemeturleri_id');
            $table->integer('onay');
            $table->bigInteger('kargo_no');
            $table->bigInteger('kargolar_id');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('satilanlar');
    }

}
