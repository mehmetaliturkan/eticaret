<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateYorumlarTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        //
        Schema::create('yorumlar', function ($table) {

            $table->increments('id');
            $table->integer('adiniz');
            $table->integer('email');
            $table->integer('urunler_id');
            $table->integer('durum');
            $table->text('yorum');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {

        schema::drop('yorumlar');
    }

}
