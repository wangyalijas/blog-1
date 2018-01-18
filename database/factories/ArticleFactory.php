<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Article::class, function (Faker $faker) {
    return [
        'title' => $faker->title(),
        'summary' => $faker->paragraph,
        'content' => $faker->realText(rand(1000, 5000)),
        'published_at' => $faker->dateTimeBetween('-30 days', '+30 days')->format('Y-m-d H:i:s')
    ];
});
