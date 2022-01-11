<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(User::class, function (Faker $faker) {
    return [
        'nombres' => $faker->name,
        'apellidos' => $faker->lastName,
        'usuario' => $faker->userName,
        'email' => $faker->unique()->safeEmail,
        'password' => encrypt('123456789'),
        'imagen' => Str::random(10).".jpg",
        'estado' => true,
        'email_verified_at' => now(),
        'remember_token' => Str::random(10),
    ];
});
