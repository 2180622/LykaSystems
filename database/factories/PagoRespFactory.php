<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\PagoResponsabilidade;
use Faker\Generator as Faker;

$factory->define(PagoResponsabilidade::class, function (Faker $faker) {
    return [
        'idPagoResp' => PagoResponsabilidade::all()->random()->id,
        'beneficiario' => $faker->randomElement($array = array ('Agente','Cliente','Universidade')),
        'valorPago' => $faker->numberBetween($min = 10, $max = 1000),
        'comprovativoPagamento' => 'default-photos/university.png',
        'dataPagamento' => $faker->date($format = 'Y-m-d', $max = 'now'),

        /*  'idFase'  'idConta'  */
    ];
});
