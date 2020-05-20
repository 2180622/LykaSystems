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
        'idUser' => $faker->unique()->numberBetween($min = 100000000, $max = 999999999),
        'password' => Hash::make('teste1234'),
        'auth_key' => strtoupper(random_str(5)),
        'loginCount' => 0,
        'estado' => true,
        'slug' => 'user',

        /*  'email'  'tipo'  'idAdmin'  'idAgente'  'idCliente'  */
    ];
});
