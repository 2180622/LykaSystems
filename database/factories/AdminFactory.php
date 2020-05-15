<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Administrador;
use Faker\Generator as Faker;

$factory->define(Administrador::class, function (Faker $faker) {
    $gender = $faker->randomElement($array = array('F','M'));
    $nome=null;
    if($gender == "F"){
        $nome = $faker->firstNameFemale;
    }else{
        $nome = $faker->firstNameMale;
    }
    return [
        'nome' => $nome,
        'apelido' => $faker->lastName,
        'genero' => $gender,
        'email' => $faker->unique()->freeEmail,
        'dataNasc' => $faker->date($format = 'Y-m-d', $max = '-30 years'),
        'fotografia' => null,
        'telefone1' => $faker->mobileNumber,
        'telefone2' => $faker->mobileNumber,
        'superAdmin' => 0,
    ];
});
