<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Transfer;
use Faker\Generator as Faker;

$factory->define(Transfer::class, function (Faker $faker) {
    return [
        'from_location' => $faker->company,
        'to_location' => $faker->company,
    ];
});
