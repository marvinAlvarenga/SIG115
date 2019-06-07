<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(App\Upkeep::class, function (Faker $faker) {
    return [
        'product_id'=> $faker->randomDigitNotNull,
        'user_id'=> $faker->randomDigit,
        'tipoEquipo' => $faker->sentence(1),
    ];
});
