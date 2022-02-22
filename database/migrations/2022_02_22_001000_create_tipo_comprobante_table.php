<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTipoComprobanteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tipo_comprobante', function (Blueprint $table) {
            $table->bigIncrements('idtipo_comprobante');
            $table->string('nombre',45)->nullable();
            $table->string('nro_correlativo',45)->nullable();
            $table->string('nro_serie',45)->nullable();
            $table->boolean('estado')->default(0);
//            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tipo_comprobante');
    }
}
