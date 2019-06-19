<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(App\Licence::class, function (Faker $faker) {
    return [
        "nombre"=>$faker->word,
        "tipo"=>$faker->word,
        "fechaVencimiento"=>$faker->date
    ];
});
