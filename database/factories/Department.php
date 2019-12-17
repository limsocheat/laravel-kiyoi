<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Department;
use Faker\Generator as Faker;

$factory->define(Department::class, function (Faker $faker) {
    return [
        'user_id' => \App\User::all()->random()->id,
        'name' => $faker->randomElement(['Sale', 'Account', 'Admin']),
        'description' => $faker->text,
        'active' => $faker->randomElement(['1', '0']),
    ];
});

$factory->define(\App\Employee::class, function (Faker $faker) {
    return [
        'department_id' => \App\Department::all()->random()->id,
        'name' => $faker->name,
        'department_name' => $faker->randomElement(['Sale', 'Account', 'Admin']),
        'description' => $faker->text,
        'active' => $faker->randomElement(['1', '0']),
        'gender' => $faker->randomElement(['Female', 'Male']),
        'phone' => $faker->phoneNumber,
        'address' => $faker->address,
        'city' => $faker->city,
        'country' => $faker->country,
    ];
});
