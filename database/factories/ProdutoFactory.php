<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Produto;
use Faker\Generator as Faker;

$factory->define(Produto::class, function (Faker $faker) {
    return [
        'nome' => 'Produto ' . rand(1, 150000),
        'categoria' => 'Categoria ' . rand(1, 3),
        'valor' => rand(1, 100),
    ];
});
