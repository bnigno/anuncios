<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ads', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('phone');
            $table->double('price',6,2);
            $table->string('bornCity')->nullable();
            $table->string('service',100);
            $table->double('weight',4.2)->nullable();
            $table->double('height',3.2)->nullable();
            $table->string('hairColor')->nullable();
            $table->string('eyeColor')->nullable();
            $table->string('race')->nullable();
            $table->integer('age');
            $table->integer('size')->nullable();
            $table->integer('hip')->nullable();
            $table->boolean('travel')->nullable();
            $table->string('description',300)->nullable();
            $table->boolean('oral')->nullable();
            $table->boolean('anal')->nullable();
            $table->boolean('kiss')->nullable();
            $table->date('startDate');
            $table->date('endDate');
            $table->timestamp('created_at');
            $table->timestamp('updated_at')->nullable();
            $table->boolean('featured');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('ads');
    }
}
