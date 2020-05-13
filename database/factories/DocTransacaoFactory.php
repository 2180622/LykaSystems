<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(Model::class, function (Faker $faker) {
    return [
        'descricao' => $faker->company,
        'valorRecebido' => $faker->company,
        'tipoPagamento' => $faker->company,
        'dataOperacao' => $faker->company,
        'dataRecebido' => $faker->company,
        'observacoes' => $faker->company,
        'comprovativoPagamento' => $faker->company,
        'verificacao' => $faker->company,
        'idConta' => $faker->company,
        'idFase' => $faker->company,
    ];
});
