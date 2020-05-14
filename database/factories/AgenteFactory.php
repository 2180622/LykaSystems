<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(Model::class, function (Faker $faker) {
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
        'tipo' => 'Agente',
        'email' => $faker->unique()->freeEmail,
        'dataNasc' => $faker->date($format = 'Y-m-d', $max = '-30 years'),
        'fotografia' => null,
        'morada' => $faker->streetAddress.' '.$faker->streetName.', '.$faker->city,
        'pais' => $faker->country,
        'NIF' => $faker->unique()->idNumber,
        'num_doc' => $faker->unique()->nationalIdNumber,
        'img_doc' => null,
        'info_doc' => null,
        'telefone1' => $faker->mobileNumber,
        'telefone2' => $faker->mobileNumber,
        'IBAN' => $faker->iban($countryCode),

        /*  'idAgenteAssociado'  */
    ];
});
