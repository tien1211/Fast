<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRateTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rate', function (Blueprint $table) {
            $table->increments('id_rate');
            $table->unsignedInteger('id_food');
            $table->unsignedInteger('id_emp');
            $table->integer('number_rate');
            $table->tinyInteger('state_rate');
            $table->timestamps();
            $table->foreign('id_food')->references('id_food')->on('food')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign('id_emp')->references('id_emp')->on('emp')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rate');
    }
}
