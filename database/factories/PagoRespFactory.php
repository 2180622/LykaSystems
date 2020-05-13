<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(Model::class, function (Faker $faker) {
    return [
        'beneficiario' => $faker->company,
        'valorPago' => $faker->company,
        'comprovativoPagamento' => $faker->company,
        'dataPagamento' => $faker->company,
        'idFase' => $faker->company,
        'idConta' => $faker->company,
    ];
});
