<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\RelFornResp;
use Faker\Generator as Faker;

$factory->define(RelFornResp::class, function (Faker $faker) {
    return [
        'idRelacao' => RelFornResp::all()->random()->id,
        'valor' => $faker->numberBetween($min = 10, $max = 100),
        'verificacaoPago' => false,
        'dataVencimento' => $faker->date($format = 'Y-m-d', $max = '+1 month'),
        'estado' => $faker->randomElement($array = array ('Pendente','Pago', 'Dívida', 'Crédito')),

        /*  'idResponsabilidade'  'idFornecedor'  */
    ];
});
