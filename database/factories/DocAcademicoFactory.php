<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\DocAcademico;
use Faker\Generator as Faker;

$factory->define(DocAcademico::class, function (Faker $faker) {
    return [
        'idDocAcademico' => $faker->unique()->numberBetween($min = 100000000, $max = 999999999),
        'nome' => $faker->sentence($nbWords = 2, $variableNbWords = true),
        'tipo' => $faker->randomElement($array = array ('Certificado','Diploma')),
        'imagem' => 'default-photos/university.png',
        'info' => '{"valor":"'.$faker->sentence($nbWords = 3, $variableNbWords = true).'"}',
        'verificacao' => false,

        'slug' => 'docacademico',
        /*  'idCliente'  'idFase'  */
    ];
});
