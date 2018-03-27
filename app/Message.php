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

class Message extends Model
{
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

}
