<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(Model::class, function (Faker $faker) {
    return [
        'nome' => $faker->company,
        'morada' => $faker->company,
        'contacto' => $faker->company,
        'descricao' => $faker->company,
        'observacoes' => $faker->company,
    ];
});
