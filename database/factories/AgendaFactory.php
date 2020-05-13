<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(Model::class, function (Faker $faker) {
    return [
        'idUser' => $faker->company,
        'idUniversidade' => $faker->company,
        'titulo' => $faker->company,
        'descricao' => $faker->company,
        'visibilidade' => $faker->company,
        'dataInicio' => $faker->company,
        'dataFim' => $faker->company,
        'cor' => $faker->company,
    ];
});
