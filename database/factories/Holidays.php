<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Holiday;
use Faker\Generator as Faker;

$factory->define(Holiday::class, function (Faker $faker) {
    return [
    	'employee_id' => \App\Employee::all()->random()->id,
        'description' => $faker->text,
        'active' => $faker->randomElement(['1', '0']),
        'from_date' => $faker->date($format = 'Y-m-d', $min = 'now'),
        'to_date' => $faker->date($format = 'Y-m-d', $min = 'now'),
    ];
});
