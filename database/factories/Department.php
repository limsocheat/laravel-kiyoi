<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Department;
use Faker\Generator as Faker;

$factory->define(Department::class, function (Faker $faker) {
    return [
        'name' => $faker->randomElement(['Sale', 'Account', 'Admin']),
        'description' => $faker->text,
        'active' => $faker->randomElement(['1', '0']),
    ];
});

$factory->define(\App\Employee::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'description' => $faker->text,
        'active' => $faker->randomElement(['1', '0']),
        'gender' => $faker->randomElement(['Female', 'Male']),
        'phone' => $faker->phoneNumber,
        'address' => $faker->address,
        'city' => $faker->city,
        'username' => $faker->randomElement(['sey','pheara','da']),
        'email' => $faker->randomElement(['sey@email.com','pheara@email.com','da@email.com']),
        'password' => $faker->randomElement(['secret']),
        'role' => $faker->randomElement(['Sale', 'Account']),
    ];
});
