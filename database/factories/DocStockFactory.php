<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(Model::class, function (Faker $faker) {
    return [
        'tipo' => $faker->company,
        'tipoDocumento' => $faker->company,
        'idFaseStock' => $faker->company,
    ];
});
