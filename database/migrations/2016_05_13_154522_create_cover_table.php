<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCoverTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cover', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('idAd')->unsigned();
            $table->string('coverName')->unique();
            $table->foreign('idAd')->references('id')->on('ads');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('cover');
    }
}
