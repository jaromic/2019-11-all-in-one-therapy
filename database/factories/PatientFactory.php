<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Patient;
use Faker\Generator as Faker;

$factory->define(Patient::class, function (Faker $faker) {

    return [
        'firstname' => $faker->firstName,
        'lastname' => $faker->lastName,
        'svnr' => rand(1000, 9999) . sprintf("%02s%02s%02s", rand(1, 28), rand(1, 12), rand(1, 99)),
        'plz' => $faker->postcode,
        'city' => $faker->city,
        'country' => 'Österreich',
        'address' => $faker->streetAddress,
        'email' => $faker->email,
    ];
});
