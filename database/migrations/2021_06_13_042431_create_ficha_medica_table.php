<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFichaMedicaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ficha_medica', function (Blueprint $table) {
            $table->id();
            $table->float('pesoInicial');
            $table->float('pesoActual');
            $table->float('alturaInicial');
            $table->float('alturaActual');
            $table->float('imc');
            $table->foreignId('id_consulta');
            $table->foreign('id_consulta')->references('id')->on('consulta');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ficha_medica');
    }
}
