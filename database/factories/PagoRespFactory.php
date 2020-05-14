<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(Model::class, function (Faker $faker) {
    return [
        'beneficiario' => $faker->randomElement($array = array ('Agente','Cliente','Universidade')),
        'valorPago' => $faker->numberBetween($min = 10, $max = 1000),
        'comprovativoPagamento' => 'default-photos/university.png',
        'dataPagamento' => $faker->date($format = 'Y-m-d', $max = 'now'),

        /*  'idFase'  'idConta'  */
    ];
});
