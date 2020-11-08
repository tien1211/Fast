<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFoodTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('food', function (Blueprint $table) {
            $table->increments('id_food');
            $table->unsignedInteger('id_cate');
            $table->unsignedInteger('id_dis');
            $table->string('name_food');
            $table->text('desc_food')->nullable();
            $table->float('price_food');
            $table->float('preprice_food')->nullable();
            $table->tinyInteger('state_food');            
            $table->timestamps();
            $table->foreign('id_cate')->references('id_cate')->on('category')
                ->onDelete('CASCADE')->onUpdate('CASCADE');
            $table->foreign('id_dis')->references('id_dis')->on('discount')
                ->onDelete('CASCADE')->onUpdate('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('food');
    }
}
