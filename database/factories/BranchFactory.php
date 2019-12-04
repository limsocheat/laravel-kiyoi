<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Branch;
use Faker\Generator as Faker;

$factory->define(Branch::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'description' => $faker->sentence,
        'active' => $faker->randomElement(['1','0']),
        'street' => $faker->streetAddress,
        'city' => $faker->city,
        'country' => $faker->country,
    ];
});
