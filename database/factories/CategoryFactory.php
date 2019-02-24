<?php

use Faker\Generator as Faker;

/*generando information aleatoria*/ 
$factory->define(App\Category::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
        'description' => $faker->paragraph(1)
    ];
});
