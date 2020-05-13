<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(Model::class, function (Faker $faker) {
    return [
        'nome' => $faker->company,
        'idUser' => $faker->company,
        'idUniversidade' => $faker->company,
        'nome' => $faker->company,
        'fotografia' => $faker->company,
        'telefone1' => $faker->company,
        'telefone2' => $faker->company,
        'email' => $faker->company,
        'fax' => $faker->company,
        'observacao' => $faker->company,
        'favorito' => $faker->company,
        'visibilidade' => $faker->company,
    ];
});
