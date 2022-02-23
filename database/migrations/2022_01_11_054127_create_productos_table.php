<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('producto', function (Blueprint $table) {
            $table->bigIncrements('idproducto');
            $table->string('codigo')->nullable();
            $table->string('nombre')->nullable();
            $table->string('slug')->nullable();
            $table->integer('stock')->nullable();
            $table->double('precio')->nullable();
            $table->boolean('destacado')->default(0);
            $table->text('descripcion')->nullable();
            $table->text('contenido')->nullable();
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
        Schema::dropIfExists('producto');
    }
}
