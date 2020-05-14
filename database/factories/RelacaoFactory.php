<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(Model::class, function (Faker $faker) {
    return [
        'valor' => $faker->numberBetween($min = 10, $max = 100),
        'verificacaoPago' => false,
        'dataVencimento' => $faker->date($format = 'Y-m-d', $max = '+1 month'),
        'estado' => $faker->randomElement($array = array ('Pendente','Pago', 'Dívida', 'Crédito')),

        /*  'idResponsabilidade'  'idFornecedor'  */
    ];
});
