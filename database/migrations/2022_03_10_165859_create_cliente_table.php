<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClienteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cliente', function (Blueprint $table) {
            $table->bigIncrements('idcliente');
            $table->integer('idtipo_documento_identidad');
            $table->integer('idusuario')->nullable();
            $table->string('nombres', 250)->nullable();
            $table->string('apellidos', 250)->nullable();
            $table->string('correo', 250)->nullable();
            $table->string('numero_documento_identidad', 250)->nullable();
            $table->string('telefono', 25)->nullable();
            $table->string('sexo', 1)->nullable();
            $table->date('fecha_nacimiento');
            $table->integer('iddepartamento')->nullable();
            $table->integer('idprovincia')->nullable();
            $table->integer('iddistrito')->nullable();
            $table->text('direccion_linea1')->nullable();
            $table->text('direccion_linea2')->nullable();
            $table->text('referencia')->nullable();
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
        Schema::dropIfExists('cliente');
    }
}
