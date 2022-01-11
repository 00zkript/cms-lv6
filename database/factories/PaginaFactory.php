<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Pagina;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Pagina::class, function (Faker $faker) {
    return [
        "slug" => str::slug($faker->sentence(7,false)),
        "titulo" => $faker->sentence(7,false),
        "subtitulo" => $faker->sentence(5,false),
        "autor" => $faker->name,
        "descripcion" => $faker->realText(200,2),
        "contenido" => $faker->randomHtml(4,6),
        "imagen" => Str::random(10).".jpg",
        "estado" => $faker->boolean,
    ];
});
