<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\DocNecessario;
use Faker\Generator as Faker;

$factory->define(DocNecessario::class, function (Faker $faker) {
    return [
        'idDocNecessario' => $faker->unique()->numberBetween($min = 100000000, $max = 999999999),
        'tipo' => $faker->randomElement($array = array ('Pessoal','Academico')),
        'tipoDocumento' => $faker->randomElement($array = array ('Diploma','Doc. Oficial')),

        /*  'idFase'  */
    ];
});
