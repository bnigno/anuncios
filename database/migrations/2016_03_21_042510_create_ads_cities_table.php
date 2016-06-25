<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdsCitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ads_cities', function (Blueprint $table) {
            $table->integer('idCities')->unsigned();
            $table->integer('idAds')->unsigned();

            $table->foreign('idCities')->references('id')->on('cities');
            $table->foreign('idAds')->references('id')->on('ads');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('ads_cities');
    }
}
