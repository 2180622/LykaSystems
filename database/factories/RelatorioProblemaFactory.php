<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\RelatorioProblema;
use Faker\Generator as Faker;

$factory->define(RelatorioProblema::class, function (Faker $faker) {
    return [
        'idRelatorioProblema' => $faker->unique()->numberBetween($min = 100000000, $max = 999999999),
        'nome' => $faker->firstNameMale.' '.$faker->lastName,
        'email' => $faker->freeEmail,
        'telemovel' => $faker->numberBetween($min = 100000000, $max = 999999999),
        'screenshot' => 'default-photos/university.png',
        'relatorio' => $faker->paragraph($nbSentences = 3, $variableNbSentences = true),
    
    ];
});
