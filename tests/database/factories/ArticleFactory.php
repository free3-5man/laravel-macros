<?php

use Faker\Generator as Faker;
use Freeman\LaravelMacros\Test\Models\Article;

$factory->define(Article::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence(),
        'content' => $faker->paragraph(),
    ];
});
