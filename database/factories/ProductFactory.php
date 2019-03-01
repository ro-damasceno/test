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

$factory->define(\App\ProductModel::class, function (Faker $faker) {
	return [
		'sku'  	  	  => substr (uniqid (), 0, 20),
		'name'  	  => $faker->text(45),
		'description' => $faker->text,
		'price' 	  => $faker->numberBetween (10, 9999)
	];
});
