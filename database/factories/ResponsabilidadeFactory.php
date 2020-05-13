<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(Model::class, function (Faker $faker) {
    return [
        'valorCliente' => $faker->company,
        'valorAgente' => $faker->company,
        'valorSubAgente' => $faker->company,
        'valorUniversidade1' => $faker->company,
        'valorUniversidade2' => $faker->company,
        'dataVencimentoCliente' => $faker->company,
        'dataVencimentoAgente' => $faker->company,
        'dataVencimentoSubAgente' => $faker->company,
        'dataVencimentoUni1' => $faker->company,
        'dataVencimentoUni2' => $faker->company,
        'verificacaoPagoCliente' => $faker->company,
        'verificacaoPagoAgente' => $faker->company,
        'verificacaoPagoSubAgente' => $faker->company,
        'verificacaoPagoUni1' => $faker->company,
        'verificacaoPagoUni2' => $faker->company,
        'idCliente' => $faker->company,
        'idAgente' => $faker->company,
        'idSubAgente' => $faker->company,
        'idUniversidade1' => $faker->company,
        'idUniversidade2' => $faker->company,
        'estado' => $faker->company,
    ];
});
