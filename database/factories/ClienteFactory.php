<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(Model::class, function (Faker $faker) {
    return [
        'idAgente' => $faker->company,
        'nome' => $faker->company,
        'apelido' => $faker->company,
        'genero' => $faker->company,
        'email' => $faker->unique()->company,
        'telefone1' => $faker->company,
        'telefone2' => $faker->company,
        'dataNasc' => $faker->company,
        'paisNaturalidade' => $faker->company,
        'morada' => $faker->company,
        'cidade' => $faker->company,
        'moradaResidencia' => $faker->company,
        'nomePai' => $faker->company,
        'telefonePai' => $faker->company,
        'emailPai' => $faker->company,
        'nomeMae' => $faker->company,
        'telefoneMae' => $faker->company,
        'emailMae' => $faker->company,
        'fotografia' => $faker->company,
        'NIF' => $faker->unique()->company,
        'IBAN' => $faker->company,
        'nivEstudoAtual' => $faker->company,
        'nomeInstituicaoOrigem' => $faker->company,
        'cidadeInstituicaoOrigem' => $faker->company,
        'num_docOficial' => $faker->unique()->company,
        'validade_docOficial' => $faker->company,
        'numPassaporte' => $faker->company,
        'obsPessoais' => $faker->company,
        'obsFinanceiras' => $faker->company,
        'obsAcademicas' => $faker->company,
    ];
});
