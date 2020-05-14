<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Universidade;
use Faker\Generator as Faker;

$factory->define(Universidade::class, function (Faker $faker) {
    return [
        'nome' => $faker->company,
        'morada' => $faker->streetAddress.' '.$faker->streetName.', '.$faker->city,
        'telefone' => $faker->p,
        'email' => $faker->companyEmail,
        'NIF' => $faker->unique()->idNumber,
        'IBAN' => $faker->iban($countryCode),
        'obsContactos' => $faker->realText($maxNbChars = 200, $indexSize = 2),
        'obsCursos' => $faker->realText($maxNbChars = 200, $indexSize = 2),
        'obsCandidaturas' => $faker->realText($maxNbChars = 200, $indexSize = 2)
    ];
});
