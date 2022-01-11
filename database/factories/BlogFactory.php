<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Blog;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Blog::class, function (Faker $faker) {
    return [
        "slug" => str::slug($faker->catchPhrase),
        "titulo" => $faker->catchPhrase,
        "subtitulo" => $faker->sentence(6,false),
        "autor" => $faker->name,
        "descripcion" => $faker->realText(200,2),
        "contenido" => $faker->randomHtml(4,6),
        "imagen" => Str::random(10).".jpg",
        "estado" => $faker->boolean,
    ];
});
