<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmpTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('emp', function (Blueprint $table) {
            $table->increments('id_emp');
            $table->string('username');
            $table->string('password');
            $table->string('name_emp');
            $table->date('birth_emp');
            $table->tinyInteger('gender_emp')->comment('0 nam # 1 nữ');
            $table->tinyInteger('per_emp')->comment('0 admin # 1 thường');
            $table->tinyInteger('state_emp')->comment('0 ngĩ #1 hoạt động');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('emp');
    }
}
