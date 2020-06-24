<?php

/** @var Factory $factory */

use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;
use Iugu\Models\Customer;

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

$factory->define(Customer::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->email,
        'cpf_cnpj' => $faker->numerify('###########'),
        'notes' =>  $faker->text,
        'number' => $faker->numerify('###'),
        'street' => $faker->streetName,
        'district' => $faker->name,
        'complement' => $faker->text(30),
        'city' => 'Araruama',
        'state' => 'RJ',
        'zip_code' => "28970000",
        'phone_prefix' => $faker->numerify('###'),
        'phone' => $faker->numerify('#########')
    ];
});
