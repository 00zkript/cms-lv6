<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmpresaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empresa', function (Blueprint $table) {
            $table->bigIncrements('idempresa');
            $table->string('titulo_general')->nullable();
            $table->string('nombre')->nullable();
            $table->text('descripcion')->nullable();
            $table->text('favicon')->nullable();
            $table->text('logo')->nullable();
            $table->text('logo2')->nullable();
            $table->string('seo_keywords')->nullable();
            $table->string('seo_description')->nullable();
            $table->string('seo_author')->nullable();
            $table->text('seguimiento_head')->nullable();
            $table->text('seguimiento_body')->nullable();
            $table->boolean('estado')->default(true);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('empresa');
    }
}
