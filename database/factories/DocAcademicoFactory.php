<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\DocAcademico;
use Faker\Generator as Faker;

$factory->define(DocAcademico::class, function (Faker $faker) {
    return [
        'nome' => $faker->sentence($nbWords = 2, $variableNbWords = true),
        'tipo' => $faker->randomElement($array = array ('Certificado','Diploma')),
        'imagem' => 'default-photos/university.png',
        'info' => '{"valor":"'.$faker->sentence($nbWords = 3, $variableNbWords = true).'"}',
        'verificacao' => false,

        /*  'idCliente'  'idFase'  */
    ];
});
