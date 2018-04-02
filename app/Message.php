<?php

/*

MODEL creado con
	
	php artisan make:model --help

Y:

	php artisan make:model name

ORM: Object Relational Mapper
Es una librería que nos ayuda a convertir un esquema relacional a un esquema de objetos, hablando de DB

*/

namespace App;

use Illuminate\Database\Eloquent\Model;

//Algolia puede ser usada luego de instalar scout:
//composer require laravel/scout
//Añadirla a providers,:
//Laravel\Scout\ScoutServiceProvider::class,
//publicarla con:
///php artisan vendor:publish --provider="Laravel\Scout\ScoutServiceProvider"
//e instalar los drivers:
//composer require algolia/algoliasearch-client-php
//y añadiendo al modelo su uso sincronizado desde su pagina:
//https://www.algolia.com
//y ejecutamos:
//php artisan scout:import App\\Message
//NO olvidar pasar ALGOLIA_APP_ID y ALGOLIA_SECRET
//a .env
//ver:
//https://www.algolia.com/doc/api-client/laravel/install/
use Laravel\Scout\Searchable;

class Message extends Model
{
	//de algolia
	use Searchable;

    /*
    Es importante conocer que
    Eloquent busca la tabla en la base de datos de .env
	con el nombre de messages, en plural, porque la clase es Message
	
	imaginemos que hay dos palabras en el nombre
	de esta clase:
	messageContent, pues Eloquent buscara una tabla
	llamada message_contents
	por convension

	*/

	//Un error de massAsignment Exception
	//usualmente refiere a poner la propiedad
	//guarded
	protected $guarded = [];

	//Esta funcion devuelve al dueño de una llave foranea
	public function user()
	{
		//toma este modelo y busca la relacion con otro 
		//modelo, en el ejemplo es User 
		//1 a 1
		return $this->belongsTo(User::class);
	}

	public function getImageAttribute($image)
	{
		//SI hay imagen devuelvo link ensamblado
		//Si hay no imagen devuelvo hhtp
		if (!$image || starts_with($image,'http') )
		{
			return $image;
		}

		return \Storage::disk('public')->url($image);
	}

	//método que sobreescribimos de use Searchable
	public function toSearchableArray()
	{
		//precargamos los usuarios
		$this->load('user');

		return $this->toArray();
	}

	//metodo para realcionar los comentarios
	//de cada mensaje
	public function responses()
	{
		//un post tiene muchos comentarios
		return $this->hasMany(Response::class)
				->orderBy("created_at", "desc");
	}
}
