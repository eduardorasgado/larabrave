<?php
/*
Un controlador se crea desde consola con:
	php artisan make:controller name
podemos usar
	php artisan make:controller --help 
para ver como armar el controlador 

Para crear los metodos de un CRUD:
php artisan make:controller nombre --resource

index,create,store,show,update,destroy
*/

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Message;

class PagesController extends Controller
{
    public function home()
    {
    	//traido del modelo
    	//en forma de un objeto que puede ser usado como array
    	//de arrays, por eso en la view podemos tomar los datos
    	//como si fuesen arrays

    	//Pero la mejor forma es traer los datos como propiedades del objeto
    	$messages = Message::paginate(10);	

	    return view('welcome',[
	    	'messages' => $messages
	    ]);
    } //home

}
