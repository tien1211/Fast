<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFoodstoreTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('foodstore', function (Blueprint $table) {
            $table->unsignedInteger('id_food');
            $table->unsignedInteger('id_store');
            $table->primary(['id_food','id_store']);
            $table->timestamps();
            $table->foreign('id_food')->references('id_food')->on('food')
                ->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign('id_store')->references('id_store')->on('store')
                ->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('foodstore');
    }
}
