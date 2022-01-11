<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\CategoriaProducto;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(CategoriaProducto::class, function (Faker $faker) {
    return [
        "slug" => str::slug($faker->sentence(3,false)),
        "nombre" => $faker->sentence(3,false),
        "descripcion" => $faker->realText(200,2),
        "imagen" => Str::random(10).".jpg",
        "estado" => $faker->boolean,
    ];
});
