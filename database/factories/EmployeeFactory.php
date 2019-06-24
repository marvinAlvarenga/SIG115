<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(App\Employee::class, function (Faker $faker) {
    return [
        "nombre"=>$faker->name,
        "ubicacion"=>$faker->word,
        "department_id"=>$faker->randomDigitNotNull,

    ];
});
