<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Biblioteca;
use Faker\Generator as Faker;

$factory->define(Biblioteca::class, function (Faker $faker) {
    return [
        'idBiblioteca' => $faker->unique()->numberBetween($min = 100000000, $max = 999999999),
        'acesso' => 'Privado',
        'descricao' => $faker->sentence($nbWords = 4, $variableNbWords = true),
        'ficheiro' => 'default-photos/university.png',
        'tipo' => 'png',
        'tamanho' => '246 KB',
        'slug' => 'biblioteca',
    ];
});
