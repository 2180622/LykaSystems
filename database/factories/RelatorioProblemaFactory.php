<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(Model::class, function (Faker $faker) {
    return [
        'nome' => $faker->firstNameMale.' '.$faker->lastName,
        'email' => $faker->freeEmail,
        'telemovel' => $faker->mobileNumber,
        'screenshot' => 'default-photos/university.png',
        'relatorio' => $faker->paragraph($nbSentences = 3, $variableNbSentences = true),
    ];
});
