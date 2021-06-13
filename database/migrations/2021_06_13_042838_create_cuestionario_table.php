<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCuestionarioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cuestionario', function (Blueprint $table) {
            $table->id();
            $table->string('enfermedadBase',30);
            $table->string('anteFamiliares',50);
            $table->integer('consumoAlcohol');
            $table->integer('consumoTabaco');
            $table->integer('consumoCafe');
            $table->string('consumoMedicamentos',50);;
            $table->integer('comidasDia');
            $table->integer('actividadFisica');
            $table->foreignId('id_fichaMedica');
            $table->foreign('id_fichaMedica')->references('id')->on('ficha_medica');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cuestionario');
    }
}
