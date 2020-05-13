<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(Model::class, function (Faker $faker) {
    return [
        'idAgenteAssociado' => $faker->company,
        'nome' => $faker->company,
        'apelido' => $faker->company,
        'genero' => $faker->company,
        'tipo' => $faker->company,
        'email' => $faker->unique()->company,
        'dataNasc' => $faker->company,
        'fotografia' => $faker->company,
        'morada' => $faker->company,
        'pais' => $faker->company,
        'NIF' => $faker->unique()->company,
        'num_doc' => $faker->unique()->company,
        'img_doc' => $faker->company,
        'info_doc' => $faker->company,
        'telefone1' => $faker->company,
        'telefone2' => $faker->company,
        'IBAN' => $faker->company,
    ];
});
