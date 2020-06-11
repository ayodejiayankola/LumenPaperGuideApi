<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\PaperStudent;
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

$factory->define(PaperStudent::class, function (Faker $faker) {
    return [
        'student_id' => $faker->numberBetween(1,10),
        'paper_id' => $faker->numberBetween(1,4),
        'marked' => $faker->numberBetween(0,1),
        'score' => $faker->numberBetween(30,100),

    ];
});
