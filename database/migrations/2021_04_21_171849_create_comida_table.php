<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComidaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comida', function (Blueprint $table) {
            $table->id();
            $table->string('descripcion',150);
            $table->foreignId('id_tipo_comida');
            $table->foreign('id_tipo_comida')->references('id')->on('tipo_comida');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('comida');
    }
}
