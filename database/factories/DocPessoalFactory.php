<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(Model::class, function (Faker $faker) {
    return [
        'tipo' => $faker->randomElement($array = array ('Doc. Pessoal','Passaport')),
        'imagem' => 'default-photos/university.png',
        'info' => '{"valor":"'.$faker->sentence($nbWords = 3, $variableNbWords = true).'"}',
        'dataValidade' => $faker->date($format = 'Y-m-d', $max = '+5 years'),
        'verificacao' => false,

        /*  'idCliente'  'idFase'  */
    ];
});
