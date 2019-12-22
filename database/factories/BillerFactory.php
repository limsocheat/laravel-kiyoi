<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Biller;
use Faker\Generator as Faker;

$factory->define(Biller::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->email,
        'phone' => $faker->phoneNumber,
        'address' => $faker->sentence,
        'company_name' => $faker->name,
        'city' => $faker->city,
    ];
});
