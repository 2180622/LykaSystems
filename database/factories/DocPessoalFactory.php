<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(Model::class, function (Faker $faker) {
    return [
        'idCliente' => $faker->company,
        'tipo' => $faker->company,
        'imagem' => $faker->company,
        'info' => $faker->company,
        'dataValidade' => $faker->company,
        'verificacao' => $faker->company,
        'idFase' => $faker->company,
    ];
});
