<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(Model::class, function (Faker $faker) {
    return [
        'acesso' => $faker->company,
        'descricao' => $faker->company,
        'ficheiro' => $faker->company,
        'tipo' => $faker->company,
        'tamanho' => $faker->company,
    ];
});
