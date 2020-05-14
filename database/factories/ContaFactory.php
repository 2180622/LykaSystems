<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(Model::class, function (Faker $faker) {
    return [
        'descricao' => $faker->sentence($nbWords = 4, $variableNbWords = true),
        'instituicao' => $faker->company,
        'titular' => $faker->firstNameFemale.' '.$faker->lastName,
        'morada' => $faker->streetAddress.' '.$faker->streetName.', '.$faker->city,
        'numConta' => $faker->unique()->bankAccountNumber,
        'IBAN' => $faker->unique()->iban($countryCode),
        'SWIFT' => $faker->unique()->swiftBicNumber,
        'contacto' => $faker->landlineNumber,
        'obsConta' => null,
    ];
});
