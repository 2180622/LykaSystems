<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\DocPessoal;
use Faker\Generator as Faker;

$factory->define(DocPessoal::class, function (Faker $faker) {
    return [
        'idDocPessoal' => $faker->unique()->numberBetween($min = 100000000, $max = 999999999),
        'tipo' => $faker->randomElement($array = array ('Doc. Pessoal','Passaport')),
        'imagem' => 'default-photos/university.png',
        'info' => '{"valor":"'.$faker->sentence($nbWords = 3, $variableNbWords = true).'"}',
        'dataValidade' => $faker->date($format = 'Y-m-d', $max = '+5 years'),
        'verificacao' => false,

        'slug' => 'docpessoal',
        /*  'idCliente'  'idFase'  */
    ];
});
