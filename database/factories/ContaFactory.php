<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(Model::class, function (Faker $faker) {
    return [
        'descricao' => $faker->company,
        'instituicao' => $faker->company,
        'titular' => $faker->company,
        'morada' => $faker->company,
        'numConta' => $faker->unique()->company,
        'IBAN' => $faker->unique()->company,
        'SWIFT' => $faker->unique()->company,
        'contacto' => $faker->company,
        'obsConta' => $faker->company,
    ];
});
