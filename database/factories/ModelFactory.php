<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(ProgramPlanner\Models\User::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->safeEmail,
        'password' => bcrypt(str_random(10)),
        'remember_token' => str_random(10),
    ];
});


$factory->define(ProgramPlanner\Models\Department::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->company,
        'description' => $faker->text(300),
    ];
});

$factory->define(ProgramPlanner\Models\Program::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->company,
        'description' => $faker->text(300),
        'credits' => $faker->randomElements($array = array ('120.0','180.0','210.0', '240.0', '360.0'), $count = 1)
    ];
});

$factory->define(ProgramPlanner\Models\Course::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->company,
        'description' => $faker->text(300),
        'course_number' => $faker->bothify("????####"),
        'level' => $faker->numberBetween(4,9),
        'credits' => $faker->randomElements($array = array ('15.0','30.0','45.0', '60.0'), $count = 1)
    ];
});
