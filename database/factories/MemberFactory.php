<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Member;
use Faker\Generator as Faker;

$factory->define(Member::class, function (Faker $faker) {
    return [
    	'user_id' => \App\User::all()->random()->id,
        'name' => $faker->name,
        'company_name' => $faker->name,
        // 'description' => $faker->text,
        'active' => $faker->randomElement(['1', '0']),
        'email' => $faker->email,
        'phone' => $faker->phoneNumber,
        // 'address' => $faker->address,
        'city' => $faker->city,
    ];
});

$factory->define(\App\Sale::class, function (Faker $faker) {
    return [
        'user_id' => \App\User::all()->random()->id,
        // 'branch_id' => \App\Branch::all()->random()->id,
        'member_id' => \App\Member::all()->random()->id,
        // 'date' => $faker->date($format = 'Y-m-d', $max = 'now'),
        'description' => $faker->text,
        'active' => $faker->randomElement(['1', '0']),
        'sale_status' => $faker->randomElement(['completed']),
        'payment_status' => $faker->randomElement(['Paid', 'Pending']),
        'total' => $faker->randomFloat($nbMaxDecimals = NULL, $min = 0, $max = NULL),
        'paid' => $faker->randomFloat($nbMaxDecimals = NULL, $min = 0, $max = NULL),
        'due' => $faker->randomFloat($nbMaxDecimals = NULL, $min = 0, $max = NULL),
    ];
});
