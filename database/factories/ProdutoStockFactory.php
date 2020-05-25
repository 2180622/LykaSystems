<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\ProdutoStock;
use Faker\Generator as Faker;

$factory->define(ProdutoStock::class, function (Faker $faker) {
    return [
        'idProdutoStock' => ProdutoStock::all()->random()->id,
        'descricao' => $faker->sentence($nbWords = 2, $variableNbWords = true),
        'tipoProduto' => $faker->randomElement($array = array ('Licenciatura','Mestrado','Curso de Verão')),
        'anoAcademico' => '2020/21',
    ];
});
