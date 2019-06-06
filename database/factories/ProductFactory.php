<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(App\Product::class, function (Faker $faker) {
    return [
        'numSe'=> $faker->randomDigit,
        'numInv'=> $faker->randomDigit,
        'marca' => $faker->sentence(1),
        'modelo' => $faker->sentence(1), 
        'estado' => $faker->randomDigit,      
        'tipo' => $faker->randomDigit,
        'fechaAdqui'=>$faker->date,
        'valorAdqui'=>$faker->randomFloat($nbMaxDecimals = 2, $min = 10, $max = 2000), 
        'garantia' => $faker->randomDigit,
        'employee_id' => 3,
    ];
});
