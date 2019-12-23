<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Branch;
use Faker\Generator as Faker;

$factory->define(Branch::class, function (Faker $faker) {
    return [
    	'user_id' => \App\User::all()->random()->id,
        'name' => $faker->name,
        'description' => $faker->sentence,
        'active' => $faker->randomElement(['1','0']),
        'address' => $faker->streetAddress,
        'city' => $faker->city,
        'country' => $faker->country,
    ];
});
