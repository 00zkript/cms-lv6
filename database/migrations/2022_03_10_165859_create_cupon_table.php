<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCuponTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cupon', function (Blueprint $table) {
            $table->bigIncrements('idcupon');
            $table->integer('idtipo_descuento');
            $table->integer('idtipo_uso');
            $table->string('nombre', 250);
            $table->decimal('monto', 11);
            $table->date('fecha_desde');
            $table->date('fecha_hasta');
            $table->decimal('monto_minimo', 11);
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
        Schema::dropIfExists('cupon');
    }
}
