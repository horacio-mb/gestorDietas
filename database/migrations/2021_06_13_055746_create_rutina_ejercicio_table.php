<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRutinaEjercicioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rutina_ejercicio', function (Blueprint $table) {
            $table->foreignId('idDiaRutina');
            $table->foreignId('idEjercicio');
            $table->integer('repeticiones');
            $table->integer('ronda');
            $table->primary(['idDiaRutina', 'idEjercicio']);
            $table->foreign('idDiaRutina')->references('id')->on('dia_rutina');
            $table->foreign('idEjercicio')->references('id')->on('ejercicio');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rutina_ejercicio');
    }
}
