<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBannerImagenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('banner_imagen', function (Blueprint $table) {
            $table->bigIncrements('idbanner_imagen');
            $table->integer('idbanner')->nullable();
            $table->string('nombre')->nullable();
            $table->integer('posicion')->default(1);
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
        Schema::dropIfExists('banner_imagen');
    }
}
