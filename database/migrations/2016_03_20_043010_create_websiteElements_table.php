<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWebsiteElementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('websiteElements', function (Blueprint $table) {
            $table->increments('id');
            $table->text('terms');
            $table->text('advertise');
            $table->string('banner1');
            $table->string('banner2');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('websiteElements');
    }
}
