<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\FaseStock;
use Faker\Generator as Faker;

$factory->define(FaseStock::class, function (Faker $faker) {
    return [
        'idFaseStock' => $faker->unique()->numberBetween($min = 100000000, $max = 999999999),
        'descricao' => $faker->randomElement($array = array ('Inscricao','Matricula', 'Final')),
        
        /*  'idProdutoStock'  */
    ];
});
