<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStoreTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('store', function (Blueprint $table) {
            $table->increments('id_store');
            $table->unsignedInteger('id_address');
            $table->string('name_store');
            $table->string('phone_store');
            $table->string('img_store');
            $table->tinyInteger('state_store');
            $table->timestamps();
            $table->foreign('id_address')->references('id_address')->on('address')
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
        Schema::dropIfExists('store');
    }
}
