<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(Model::class, function (Faker $faker) {
    return [
        'descricao' => $faker->sentence($nbWords = 2, $variableNbWords = true),
        'tipoProduto' => $faker->randomElement($array = array ('Licenciatura','Mestrado','Curso de Verão')),
        'anoAcademico' => '2020/21',
    ];
});
