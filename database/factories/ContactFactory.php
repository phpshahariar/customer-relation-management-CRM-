<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Contact;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Contact::class, function (Faker $faker) {
    return [
        'group_name' => $faker->name,
        'name' => $faker->name,
        'phone' => $faker->phoneNumber,
        'email' => $faker->unique()->safeEmail,
        'remember_token' => Str::random(10),
    ];
});
