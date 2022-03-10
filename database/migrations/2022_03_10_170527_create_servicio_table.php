<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServicioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('servicio', function (Blueprint $table) {
            $table->bigIncrements('idservicio');
            $table->string('slug')->nullable();
            $table->string('nombre')->nullable();
            $table->text('descripcion')->nullable();
            $table->text('contenido')->nullable();
            $table->text('imagen')->nullable();
            $table->boolean('estado')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('servicio');
    }
}
