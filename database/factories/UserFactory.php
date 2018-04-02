<?php

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
	
	Sirve para hacer TESTING DE LA WEB APP 

|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'username' => $faker->userName,
        'email' => $faker->unique()->safeEmail,
        'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
        'remember_token' => str_random(10),
        'avatar' =>$faker->imageUrl(300,300,'people'),
    ];
});

/*
En Model Factories se crean modelos de usuarios o lo que necesite nuestra aplicacion de forma fake, con el fin de hacer testing automatico, o testing sin que nosotros metamos las manos en los forms, creacion de mensajes etc que necesite nuestra web app
*/
$factory->define(App\Message::class, function(Faker $faker){
	return [
		//words(5,true) true devuelve texto, con false
		//se devuelve un array, asi mismo hay 
		//paragraph, realText
		//
		'content' => $faker->realText(random_int(20, 160)),
		'image' => $faker->imageUrl(600,338),
		'created_at' => $faker->dateTimeThisDecade,
		'updated_at' => $faker->dateTimeThisDecade,
	];
});

$factory->define(App\Response::class, function (Faker $faker){
	return [
		'message' => $faker->words(3, true),
		'created_at' => $faker->dateTimeThisYear,
		'updated_at' => $faker->dateTimeThisYear,
	];
});


/*

PARA VER COMO FUNCIONA FACTORY

Debemos tener Tinker, revisando en composer.json si tenemos la dependencia externa, en caso contrario, debemos integrarla

tinker usualmente viene sin ser integrada directamente al
proyecto para darnos eleccion si meterla o no en desarrollo o produccion

Por otra parte una vez confirmado recurrimos a app/config/app.php y vamos a providers a comprobar como integrar eso con "use" 
Si no esta, lo incluimos como:

	Laravel\Tinker\TinkerServiceProvider::class,

y ejecutamos en consola:

	composer install 

dentro del proyecto

Ahora:

	php artisan tinker

ya en consola de tinker:

	>>>$message = factory(App\Message::class)->create()

Que creara ejemplos de muestra sin tocar la DB, pero al
ejecutar:

	>>>$message = factory(App\Message::class)->create()

guardara los datos que consiga de los fake data en la DB

PERO ASI NO SE HACE TESTING, RECURRIREMOS A SEEDS PARA HACERLO DE FORMA MAS PROFESIONAL

Vamos a database/seeds/DatabaseSeeder.php


*/