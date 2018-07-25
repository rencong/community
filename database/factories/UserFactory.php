<?php

use Faker\Generator as Faker;

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

$factory->define(App\Model\User::class, function (Faker $faker) {
    return [
        'name'           => $faker->name,
        'email'          => $faker->unique()->safeEmail,
        'avatar'         => $faker->imageUrl(256, 256),
        'password'       => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Model\Discussion::class, function (Faker $faker) {
    $user_ids = \App\Model\User::all()->pluck('id')->toArray();
    return [
        'title'        => $faker->sentence,
        'body'         => $faker->paragraph,
        'user_id'      => $faker->randomElement($user_ids),
        'last_user_id' => $faker->randomElement($user_ids),
    ];
});