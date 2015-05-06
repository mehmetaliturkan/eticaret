<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdresdefterleriTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
            Schema::create('adresdefterim', function($table){
                
                $table->increments('id');
                $table->integer('user_id');
                $table->string('adi');
                $table->string('adsoyad');
                $table->text('adres');
                $table->string('ulke');
                $table->string('sehir');
                $table->string('ilce');
                $table->integer('telefon');
                $table->integer('cepno');
                $table->string('tipi');
                $table->integer('tcno');
                $table->integer('vergino');
                $table->string('vergidairesi');
                
            });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		//
                Schema::drop('adresdefterim');
	}

}
