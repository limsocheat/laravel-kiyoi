<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Supplier;
use Faker\Generator as Faker;

$factory->define(Supplier::class, function (Faker $faker) {
    return [
        // 'purchase_id' => \App\Purchase::all()->random()->id,
        'name' => $faker->name,
        'description' => $faker->text,
        'active' => $faker->randomElement(['1', '0']),
        'company_name' => $faker->name,
        'email' => $faker->email,
        'phone' => $faker->phoneNumber,
        'address' => $faker->address,
    ];
});
