<?php

/** @var Factory $factory */

use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;
use Iugu\Models\Charge;

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

$factory->define(Charge::class, function (Faker $faker) {
    return [
        'email' => $faker->email,
        'token' => $faker->uuid,
        'itens' => [
            [
                'description'   =>  $faker->name,
                'quantity'  =>  1,
                'price_cents'   =>  100
            ]
        ]
    ];
});
