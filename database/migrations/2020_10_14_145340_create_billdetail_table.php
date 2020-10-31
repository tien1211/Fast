<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBilldetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('billdetail', function (Blueprint $table) {
            $table->unsignedInteger('id_food');
            $table->unsignedInteger('id_bill');
            $table->float('qty_billdetail');
            $table->integer('price_billdetail');
            $table->tinyInteger('state_billdetail');
            $table->primary(['id_food','id_bill']);
            $table->timestamps();
            $table->foreign('id_food')->references('id_food')->on('food')
                ->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign('id_bill')->references('id_bill')->on('bill')
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
        Schema::dropIfExists('billdetail');
    }
}
