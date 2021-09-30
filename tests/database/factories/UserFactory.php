<?php

use Faker\Generator as Faker;
use Freeman\LaravelMacros\Test\Models\User;

$factory->define(User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'birthday' => $faker->date(),
        'age' => $faker->numberBetween(18, 60),
    ];
});
