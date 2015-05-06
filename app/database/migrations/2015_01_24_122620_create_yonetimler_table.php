<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateYonetimlerTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('yonetim', function($table) { 
            $table->increments('id');
            $table->string('user_id')->unique();
            $table->string('last_name');
            $table->string('first_name');
            $table->string('email');
            $table->string('password');
            $table->integer('seviye');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('yonetim');
    }

}
