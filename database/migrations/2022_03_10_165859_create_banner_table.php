<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBannerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('banner', function (Blueprint $table) {
            $table->bigIncrements('idbanner');
            $table->string('pagina', 250)->nullable();
            $table->string('titulo')->nullable();
            $table->string('subtitulo')->nullable();
            $table->text('contenido')->nullable();
            $table->string('ruta')->nullable();
            $table->text('imagen')->nullable();
            $table->integer('posicion')->nullable();
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
        Schema::dropIfExists('banner');
    }
}
