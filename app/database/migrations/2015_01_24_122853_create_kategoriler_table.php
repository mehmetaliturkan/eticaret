<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKategorilerTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
            Schema::create('kategoriler', function ($table){
                $table->increments('id');
                $table->string('adi');
                $table->integer('ust_id');
                $table->string('aciklama');
                $table->integer('durum');
                
                $table->timestamps();
                
            });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
            Schema::drop('kategoriler');
	}

}
