<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
use App\Article;
use Carbon\Carbon;
use Faker\Generator as Faker;

$factory->define(Article::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence(),
        'content' => $faker->paragraph(10),
        'user_id' => factory(User::class)->create()->id,
        'published_at' => Carbon::now()->subWeeks(1),
    ];
});

$factory->state(Article::class, 'published', [
    'published_at' => Carbon::now()->subWeeks(1),
]);

$factory->state(Article::class, 'unpublished', [
    'published_at' => null,
]);
