<?php

/** @var Factory $factory */

use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;
use Iugu\Models\Plan;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(Plan::class, function (Faker $faker) {
    return [
        'iugu_id'=> $faker->uuid,
        'identifier' => $faker->word,
        'interval' => $faker->numerify('#'),
        'interval_type' => $faker->shuffle(['weeks','months']),
        ''
    ];
});
