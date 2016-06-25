<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReportedTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reported', function (Blueprint $table) {
            $table->increments('id');
            $table->string('comment',300);
            $table->integer('idAd')->unsigned();
            $table->datetime('createdAt');

            $table->foreign('idAd')->references('id')->on('Ads');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('reported');
    }
}
