<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(App\Spare::class, function (Faker $faker) {
    return [
        'nombre'=> $faker->word,
        'tipo'=> $faker->randomDigit,
        'marca' => $faker->word,     
        'valorAdqui' => $faker->randomFloat($nbMaxDecimals = NULL, $min = 0, $max = 2000),
    ];
});
