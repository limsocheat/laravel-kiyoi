<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Payroll;
use Faker\Generator as Faker;

$factory->define(Payroll::class, function (Faker $faker) {
    return [
    	'employee_id' => \App\Employee::all()->random()->id,
    	'account_id' => \App\Account::all()->random()->id,
        // 'date' => $faker->date($format = 'Y-m-d', $max = 'now'),
        'employee_name' =>  $faker->name,
        'description' =>  $faker->text,
        'account_name' =>  $faker->randomElement(['Nami', 'Dalie']),
        'amount' =>  $faker->numberBetween($min=10, $max=10000),
        'method' =>  $faker->randomElement(['Cash', 'Cheque', 'Credit Card']),
    ];
});
