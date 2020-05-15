<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\DocStock;
use Faker\Generator as Faker;

$factory->define(DocStock::class, function (Faker $faker) {
    return [
        'tipo' => $faker->randomElement($array = array ('Pessoal','Academico')),
        'tipoDocumento' => $faker->randomElement($array = array ('Diploma','Doc. Oficial')),

        /*  'idFaseStock'  */
    ];
});
