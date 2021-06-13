<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiaRutinaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dia_rutina', function (Blueprint $table) {
            $table->id();
            $table->string('diaSemana',30);
            $table->foreignId('idGestRutina');
            $table->foreign('idGestRutina')->references('id')->on('gest_rutina');           
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dia_rutina');
    }
}
