<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(Model::class, function (Faker $faker) {
    return [
        'valor' => $faker->company,
        'verificacaoPago' => $faker->company,
        'dataVencimento' => $faker->company,
        'estado' => $faker->company,
        'idResponsabilidade' => $faker->company,
        'idFornecedor' => $faker->company,
    ];
});
