<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Fase;
use Faker\Generator as Faker;

$factory->define(Fase::class, function (Faker $faker) {
    return [
        'idFase' => $faker->unique()->numberBetween($min = 100000000, $max = 999999999),
        'descricao' => $faker->randomElement($array = array ('Inscricao','Matricula', 'Final')),
        'dataVencimento' => $faker->date($format = 'Y-m-d', $max = '+5 days'),
        'valorFase' => $faker->numberBetween($min = 100, $max = 1000),
        'verificacaoPago' => false,
        'icon' => 'default-photos/university.png',
        'estado' => $faker->randomElement($array = array ('Pendente','Pago', 'Dívida', 'Crédito')),

        'slug' => 'fase',
        /*  'idProduto'  'idResponsabilidade'  */
    ];
});
