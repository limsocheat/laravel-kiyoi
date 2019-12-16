<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Attendance;
use Faker\Generator as Faker;

$factory->define(Attendance::class, function (Faker $faker) {
    return [
    	'employee_id' => \App\Employee::all()->random()->id,
        'date' => $faker->date($format = 'Y-m-d', $max = 'now'),
        'employee_name' => $faker->name,
        'description' => $faker->text,
        'active' => $faker->randomElement(['1', '0']),
        'checkin' => $faker->time($format = 'H:i:s', $max = 'now'),
        'checkout' => $faker->time($format = 'H:i:s', $max = 'now'),
        'status' => $faker->randomElement(['Present', 'Absent', 'Late']),
    ];
});
