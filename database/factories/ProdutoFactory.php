<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(Model::class, function (Faker $faker) {
    return [
        'descricao' => $faker->company,
        'tipo' => $faker->company,
        'anoAcademico' => $faker->company,
        'valorTotal' => $faker->company,
        'valorTotalAgente' => $faker->company,
        'valorTotalSubAgente' => $faker->company,
        'estado' => $faker->company,
        'idAgente' => $faker->company,
        'idSubAgente' => $faker->company,
        'idCliente' => $faker->company,
        'idUniversidade1' => $faker->company,
        'idUniversidade2' => $faker->company,
    ];
});
