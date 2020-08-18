<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Events;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(App\Events::class, function (Faker $faker) {
    return [
        'name' => $faker->jobTitle,
    ];
});
