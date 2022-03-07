<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProyectoImagensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('proyecto_imagen', function (Blueprint $table) {
            $table->bigIncrements('idproyecto_imagen');
            $table->integer('idproyecto')->nullable();
            $table->string('nombre')->nullable();
            $table->integer('posicion')->default(1);
            $table->boolean('estado')->default(false);
            // $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('proyecto_imagen');
    }
}
