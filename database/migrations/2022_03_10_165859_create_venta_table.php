<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVentaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('venta', function (Blueprint $table) {
            $table->bigIncrements('idventa');
            $table->integer('idtransaccion')->nullable();
            $table->integer('idstatus_venta')->nullable();
            $table->integer('idstatus_envio')->nullable();
            $table->integer('idcupon')->nullable();
            $table->integer('total')->nullable();
            $table->integer('precio_envio')->nullable();
            $table->integer('descuento')->nullable();
            $table->integer('total_final')->nullable();
            $table->integer('receptor_pedido')->nullable();
            $table->integer('cliente_idcliente')->nullable();
            $table->text('cliente_telefono')->nullable();
            $table->text('cliente_direccion_linea1')->nullable();
            $table->text('cliente_direccion_linea2')->nullable();
            $table->text('cliente_referencia')->nullable();
            $table->integer('cliente_iddepartamento')->nullable();
            $table->integer('cliente_idprovincia')->nullable();
            $table->integer('cliente_iddistrito')->nullable();
            $table->integer('facturacion_idtipo_comprobante')->nullable();
            $table->integer('facturacion_nro_comprobante')->nullable();
            $table->integer('facturacion_ruc')->nullable();
            $table->integer('facturacion_razonsocial')->nullable();
            $table->integer('pago_idmetodo_pago')->nullable();
            $table->integer('pago_idstatus_pago')->nullable();
            $table->string('pago_mercadopago_id')->nullable();
            $table->string('pago_ticket')->nullable();
            $table->string('pago_cuotas')->nullable();
            $table->string('pago_cip')->nullable();
            $table->dateTime('pago_expira_cip')->nullable();
            $table->string('pago_email')->nullable();
            $table->string('pago_mensaje')->nullable();
            $table->dateTime('fecha_registro')->nullable();
            $table->dateTime('fecha_pago')->nullable();
            $table->integer('estado')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('venta');
    }
}
