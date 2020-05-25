<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\FaseStock;
use Faker\Generator as Faker;

$factory->define(FaseStock::class, function (Faker $faker) {
    return [
        'idFaseStock' => FaseStock::all()->random()->id,
        'descricao' => $faker->randomElement($array = array ('Inscricao','Matricula', 'Final')),
        
        /*  'idProdutoStock'  */
    ];
});
