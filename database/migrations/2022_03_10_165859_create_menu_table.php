<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMenuTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menu', function (Blueprint $table) {
            $table->bigIncrements('idmenu');
            $table->integer('pariente')->nullable();
            $table->string('nombre')->nullable();
            $table->string('slug')->nullable();
            $table->integer('idtipo_ruta')->nullable();
            $table->string('ruta')->nullable();
            $table->integer('posicion')->nullable();
            $table->boolean('estado')->default(false);
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
        Schema::dropIfExists('menu');
    }
}
