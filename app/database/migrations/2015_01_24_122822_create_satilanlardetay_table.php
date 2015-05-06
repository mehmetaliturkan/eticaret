<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSatilanlarDetayTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('satilanlardetay', function($table) {
            $table->increments('id');
            $table->integer('satilanlar_id');
            $table->integer('urun_id');
            $table->integer('adet');
            $table->integer('fiyat');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('satilanlardetay');
    }

}
