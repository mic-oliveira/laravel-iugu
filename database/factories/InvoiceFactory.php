<?php

/** @var Factory $factory */

use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;
use Iugu\Models\Invoice;

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

$factory->define(Invoice::class, function (Faker $faker) {
    return [
        'iugu_id' => $faker->uuid,
        'email' => $faker->email,
        'price_cents' => $faker->numerify('###'),
        'due_date' => now()->addWeekdays(1),
        'currency' => 'BRL',
        'items' => [
            [
                'description' => $faker->name,
                'quantity' => 1,
                'price_cents' => 1000
            ]
        ]
    ];
});
