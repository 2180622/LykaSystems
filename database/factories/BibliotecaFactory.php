<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Biblioteca;
use Faker\Generator as Faker;

$factory->define(Biblioteca::class, function (Faker $faker) {
    return [
        'acesso' => 'Privado',
        'descricao' => $faker->sentence($nbWords = 4, $variableNbWords = true),
        'ficheiro' => $faker->file($sourceDir, $targetDir, false),
        'tipo' => 'jpg',
        'tamanho' => '246',
    ];
});
