<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(Model::class, function (Faker $faker) {
    return [
        'nome' => $faker->firstNameFemale.' '.$faker->lastName,
        'morada' => $faker->streetAddress.' '.$faker->streetName.', '.$faker->city,
        'contacto' => $faker->mobileNumber,
        'descricao' => $faker->sentence($nbWords = 7, $variableNbWords = true),
        'observacoes' => null,
    ];
});
