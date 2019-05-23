<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSlidersLangsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sliders_langs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('lang', 5);
            $table->string('first_title', 100);
            $table->string('second_title', 255);
            $table->string('desc', 255);
            $table->unsignedInteger('slider_id');

            $table->foreign('slider_id')->references('id')->on('sliders')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sliders_langs');
    }
}
