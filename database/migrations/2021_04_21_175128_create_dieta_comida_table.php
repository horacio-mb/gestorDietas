<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDietaComidaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dieta_comida', function (Blueprint $table) {
            $table->foreignId('id_dieta');
            $table->foreignId('id_comida');
            $table->string('distribucion',30);
            $table->primary(['id_dieta', 'id_comida']);
            $table->foreign('id_dieta')->references('id')->on('dieta');
            $table->foreign('id_comida')->references('id')->on('comida');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dieta_comida');
    }
}
