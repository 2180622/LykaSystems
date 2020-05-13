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
        'email' => $faker->unique()->company,
        'tipo' => $faker->company,
        'password' => $faker->company,
        'auth_key' => $faker->company,
        'loginCount' => $faker->company,
        'estado' => $faker->company,
        'idAdmin' => $faker->company,
        'idAgente' => $faker->company,
        'idCliente' => $faker->company,
    ];
});
