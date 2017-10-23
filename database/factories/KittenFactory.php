<?php

/**
 * This factory generates kittens
 *
 */

use Faker\Generator as Faker;
use App\Models\Kitten;

$factory->define(Kitten::class, function (Faker $faker) {

    return [
        'firstName' => $faker->firstName(),
        'lastName' => $faker->lastName(),
        'gender' => rand(0,1) == 1 ? 'f' : 'm',
        'color' => $faker->colorName(),
        'dob' => $faker->dateTimeBetween($startDate = '-5 years', $endDate = 'now')
    ];
});
