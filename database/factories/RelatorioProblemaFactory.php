<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(Model::class, function (Faker $faker) {
    return [
        'nome' => $faker->company,
        'email' => $faker->company,
        'telemovel' => $faker->company,
        'screenshot' => $faker->company,
        'relatorio' => $faker->company,
    ];
});
