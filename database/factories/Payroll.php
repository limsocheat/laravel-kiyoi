<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Payroll;
use Faker\Generator as Faker;

$factory->define(Payroll::class, function (Faker $faker) {
    return [
        'date' => $faker->date($format = 'Y-m-d', $max = 'now'),
        'employee_name' =>  $faker->name,
        'description' =>  $faker->text,
        'account' =>  $faker->randomElement(['Nami', 'Dalie']),
        'amount' =>  $faker->numberBetween($min=10, $max=10000),
        'method' =>  $faker->randomElement(['Cash', 'Cheque', 'Credit Card']),
    ];
});
