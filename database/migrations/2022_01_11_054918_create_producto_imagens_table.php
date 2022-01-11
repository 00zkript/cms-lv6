<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductoImagensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('producto_imagen', function (Blueprint $table) {
            $table->bigIncrements('idproducto_imagen');
            $table->integer('idproducto')->nullable();
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
        Schema::dropIfExists('producto_imagen');
    }
}
