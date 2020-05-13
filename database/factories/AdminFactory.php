<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(Model::class, function (Faker $faker) {
    return [
        'nome' => $faker->company,
        'apelido' => $faker->company,
        'genero' => $faker->company,
        'email' => $faker->unique()->company,
        'dataNasc' => $faker->company,
        'fotografia' => $faker->company,
        'telefone1' => $faker->company,
        'telefone2' => $faker->company,
        'superAdmin' => $faker->company,
    ];
});
