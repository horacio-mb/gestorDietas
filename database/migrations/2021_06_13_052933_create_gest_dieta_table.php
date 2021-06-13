<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGestDietaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gest_dieta', function (Blueprint $table) {
            $table->id();
            $table->foreignId('idFichaMedica');
            $table->date('fechaInicio');
            $table->date('fechaFinal');
            $table->string('tipo',30);           
            $table->foreign('idFichaMedica')->references('id')->on('ficha_medica');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('gest_dieta');
    }
}
