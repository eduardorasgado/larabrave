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

$factory->define(App\User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
        'remember_token' => str_random(10),
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
		'content' => $faker->realText(),
		'image' => $faker->imageUrl(600,338)

	];
});

/*
Para activar las factories lo hacemos con Tinker, revisando en composer.json si tenemos la dependencia externa, en caso contrario, debemos integrarla

tinker usualmente viene sin ser integrada directamente al
proyecto para darnos eleccion si meterla o no en desarrollo o produccion

Por otra parte una vez confirmado recurrimos a app/cinfig/app.php y vamos a providers a comprobar como integrar eso con "use" 

*/