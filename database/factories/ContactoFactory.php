<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(Model::class, function (Faker $faker) {
    return [
        'nome' => $faker->firstNameFemale,
        'fotografia' => null,
        'telefone1' => $faker->mobileNumber,
        'telefone2' => $faker->mobileNumber,
        'email' => $faker->freeEmail,
        'fax' => null,
        'observacao' => null,
        'favorito' => false,
        'visibilidade' => true,

        /*  'idUser'  'idUniversidade'  */
    ];
});
