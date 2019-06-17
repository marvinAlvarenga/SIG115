<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(App\Product::class, function (Faker $faker) {
    return [
        'numSe'=> $faker->randomFLoat($nbMaxDecimals = 0, $min = 1000000, $max = 2000000000),
        'numInv'=> $faker->randomFloat($nbMaxDecimals = 0, $min = 1000000, $max = 200000000),
        'marca' => $faker->word,
        'modelo' => $faker->sentence(1), 
        'estado' => $faker->numberBetween($min = 1, $max = 3),   
        'tipo' => $faker->numberBetween($min = 1, $max = 2),
        'fechaAdqui'=>$faker->date,
        'valorAdqui'=>$faker->randomFloat($nbMaxDecimals = 2, $min = 10, $max = 2000), 
        'garantia' => $faker->randomDigit,
        'employee_id' => $faker->numberBetween($min = 1, $max = 25),
    ];
});
