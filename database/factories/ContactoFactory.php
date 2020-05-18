<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Contacto;
use Faker\Generator as Faker;

$factory->define(Contacto::class, function (Faker $faker) {
    return [
        'nome' => $faker->firstNameFemale,
        'fotografia' => null,
        'telefone1' => $faker->numberBetween($min = 100000000, $max = 999999999),
        'telefone2' => $faker->numberBetween($min = 100000000, $max = 999999999),
        'email' => $faker->freeEmail,
        'fax' => null,
        'observacao' => null,
        'favorito' => false,
        'visibilidade' => true,

        /*  'idUser'  'idUniversidade'  */
    ];
});
