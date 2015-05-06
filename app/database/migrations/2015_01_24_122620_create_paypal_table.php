<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaypalTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('paypal', function($table) {
            $table->increments('id');
            $table->integer('users_id');
            $table->integer('satilanlar_id');
            $table->text('ip');
            $table->text('tx_kod');
            $table->text('st_durum');
            $table->text('amt_tl');
            $table->text('cc_birimi');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('paypal');
    }

}
