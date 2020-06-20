<?php

/** @var Factory $factory */

use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;
use Iugu\Models\Subscription;

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

$factory->define(Subscription::class, function (Faker $faker) {
    return [
        'iugu_id' => $faker->uuid,
        'plan_identifier' => $faker->word,
        'only_on_charge_success' => $faker->shuffle(['true','false']),
        'ignore_due_email'=> true,
        'price_cents' => $faker->numerify('###'),
        'payable_with' => 'all',
        'credits_based'=> false,
    ];
});
