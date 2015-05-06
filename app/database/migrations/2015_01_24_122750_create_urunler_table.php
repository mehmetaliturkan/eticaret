<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUrunlerTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('urunler', function($table) {
            $table->increments('id');
            $table->string('adi');
            $table->integer('kategori_id');
            $table->integer('adet');
            $table->integer('satilan');
            $table->integer('spot');
            $table->integer('fiyat');
            $table->integer('indirim');
            $table->string('kod');
            $table->text('detay');
            $table->string('firsat');
            $table->string('durum');
            $table->string('link')->unique();
            $table->integer('gosterim');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('urunler');
    }

}
