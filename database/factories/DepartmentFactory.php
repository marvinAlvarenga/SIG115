<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(App\Department::class, function (Faker $faker) {
    return [
        "nombre"=>$faker->word
    ];
});
