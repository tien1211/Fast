<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBillTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bill', function (Blueprint $table) {
            $table->increments('id_bill');
            $table->unsignedInteger('id_emp');
            $table->unsignedInteger('id_del');
            $table->dateTime('date_bill');
            $table->tinyInteger('state_bill');
            $table->timestamps();
            $table->foreign('id_emp')->references('id_emp')->on('emp')->onDelete('CASCADE')->onUpdate('CASCADE');
            $table->foreign('id_del')->references('id_del')->on('delivery')->onDelete('CASCADE')->onUpdate('CASCADE');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bill');
    }
}
