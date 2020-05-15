<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Cliente;
use Faker\Generator as Faker;

$factory->define(Cliente::class, function (Faker $faker) {
    $gender = $faker->randomElement($array = array('F','M'));
    $nome=null;
    if($gender == "F"){
        $nome = $faker->firstNameFemale;
    }else{
        $nome = $faker->firstNameMale;
    }
    $apelido = $faker->lastName;
    return [
        'nome' => $nome,
        'apelido' => $apelido,
        'genero' => $gender,
        'email' => $faker->unique()->freeEmail,
        'telefone1' => $faker->mobileNumber,
        'telefone2' => $faker->mobileNumber,
        'dataNasc' => $faker->date($format = 'Y-m-d', $max = '-20 years'),
        'paisNaturalidade' => $faker->country,
        'morada' => $faker->streetAddress.' '.$faker->streetName,
        'cidade' => $faker->city,
        'moradaResidencia' => $faker->streetAddress.' '.$faker->streetName.', '.$faker->city,
        'nomePai' => $faker->firstNameMale.' '.$apelido,
        'telefonePai' => $faker->mobileNumber,
        'emailPai' => $faker->freeEmail,
        'nomeMae' => $faker->firstNameFemale.' '.$apelido,
        'telefoneMae' => $faker->mobileNumber,
        'emailMae' => $faker->freeEmail,
        'fotografia' => null,
        'NIF' => $faker->unique()->idNumber,
        'IBAN' => $faker->iban($countryCode),
        'nivEstudoAtual' => '0',
        'nomeInstituicaoOrigem' => $faker->company,
        'cidadeInstituicaoOrigem' => $faker->city,
        'num_docOficial' => $faker->unique()->nationalIdNumber,
        'validade_docOficial' => $faker->date($format = 'Y-m-d', $max = '+5 years'),
        'numPassaporte' => $faker->nationalIdNumber,
        'obsPessoais' => $faker->paragraph($nbSentences = 3, $variableNbSentences = true),
        'obsFinanceiras' => null,
        'obsAcademicas' => null,

        /*  'idAgente'  */
    ];
});
