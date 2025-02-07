<?php
use App\Product;
use App\User;

use Faker\Generator as Faker;

/*generando information aleatoria*/ 
$factory->define(App\Product::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
        'description' => $faker->paragraph(1),
        'quantity'  => $faker->numberBetween(1,10),
        'status' => $faker->randomElement([Product::AVAILABLE, 
                                           Product::NOT_AVAILABLE]),
        'seller_id' => User::all()->random()->id,                                   
    ];
});
