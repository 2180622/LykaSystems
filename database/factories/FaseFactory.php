<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(Model::class, function (Faker $faker) {
    return [
        'descricao' => $faker->company,
        'dataVencimento' => $faker->company,
        'valorFase' => $faker->company,
        'verificacaoPago' => $faker->company,
        'icon' => $faker->company,
        'estado' => $faker->company,
        'idProduto' => $faker->company,
        'idResponsabilidade' => $faker->company,
    ];
});
