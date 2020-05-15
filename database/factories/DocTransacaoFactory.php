<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\DocTransacao;
use Faker\Generator as Faker;

$factory->define(DocTransacao::class, function (Faker $faker) {
    return [
        'descricao' => $faker->sentence($nbWords = 5, $variableNbWords = true),
        'valorRecebido' => null,
        'tipoPagamento' => $faker->randomElement($array = array ('Transferencia Bancaria','Paypal')),
        'dataOperacao' => $faker->date($format = 'Y-m-d', $max = 'now'),
        'dataRecebido' => null,
        'observacoes' => null,
        'comprovativoPagamento' => 'default-photos/university.png',
        'verificacao' => false,

        /*  'idConta'  'idFase'  */
    ];
});
