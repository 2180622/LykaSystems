<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\PagoResponsabilidade;
use Faker\Generator as Faker;

$factory->define(PagoResponsabilidade::class, function (Faker $faker) {
    return [
        'idPagoResp' => $faker->unique()->numberBetween($min = 100000000, $max = 999999999),
        'beneficiario' => $faker->randomElement($array = array ('Agente','Cliente','Universidade')),
        'valorPago' => $faker->numberBetween($min = 10, $max = 1000),
        'comprovativoPagamento' => 'default-photos/university.png',
        'dataPagamento' => $faker->date($format = 'Y-m-d', $max = 'now'),

        /*  'idFase'  'idConta'  */
    ];
});
