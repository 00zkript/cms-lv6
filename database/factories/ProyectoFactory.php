<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Proyecto;
use Faker\Generator as Faker;
use Illuminate\Support\Str;


$factory->define(Proyecto::class, function (Faker $faker) {
    return [
        "slug" => str::slug($faker->catchPhrase),
        "nombre" => $faker->catchPhrase,
        "descripcion" => $faker->realText(200,2),
        "contenido" => $faker->randomHtml(4,6),
        "imagen" => Str::random(10).".jpg",
        "estado" => $faker->boolean,
    ];
});
