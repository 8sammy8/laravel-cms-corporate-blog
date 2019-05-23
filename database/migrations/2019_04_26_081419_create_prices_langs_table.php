<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePricesLangsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prices_langs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('lang', 5);
            $table->string('title', 50);
            $table->json('bonus');
            $table->json('options');
            $table->unsignedInteger('price_id');

            $table->foreign('price_id')->references('id')->on('prices')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('prices_langs');
    }
}
