<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Agente;
use Faker\Generator as Faker;

$factory->define(Agente::class, function (Faker $faker) {
    $gender = $faker->randomElement($array = array('F','M'));
    $nome=null;
    if($gender == "F"){
        $nome = $faker->firstNameFemale;
    }else{
        $nome = $faker->firstNameMale;
    }
    return [
        'idAgente' => Agente::all()->random()->id,
        'nome' => $nome,
        'apelido' => $faker->lastName,
        'genero' => $gender,
        'tipo' => 'Agente',
        'email' => $faker->unique()->freeEmail,
        'dataNasc' => $faker->date($format = 'Y-m-d', $max = '-30 years'),
        'fotografia' => null,
        'morada' => $faker->streetAddress.' '.$faker->streetName.', '.$faker->city,
        'pais' => $faker->country,
        'NIF' => $faker->unique()->numberBetween($min = 100000000, $max = 999999999),
        'num_doc' => $faker->unique()->phoneNumber,
        'img_doc' => null,
        'telefone1' => $faker->numberBetween($min = 100000000, $max = 999999999),
        'telefone2' => $faker->numberBetween($min = 100000000, $max = 999999999),
        'IBAN' => $faker->iban('351'),

        'slug' => $nome,
        /*  'idAgenteAssociado'  */
    ];
});
