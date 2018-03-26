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

class PagesController extends Controller
{
    public function home()
    {
    	$messages = [
    		[
    			'id' => 1,
	    		'content' => 'Este es mi primer mensaje!',
	    		'image' => 'http://placeimg.com/600/338/any?1'
    		],
    		[
    			'id' => 2,
	    		'content' => 'Este es mi segundo mensaje!',
	    		'image' => 'http://placeimg.com/600/338/any?2'
    		],
    		[
    			'id' => 3,
	    		'content' => 'Este es mi tercer mensaje!',
	    		'image' => 'http://placeimg.com/600/338/any?3'
    		],
    		[
    			'id' => 4,
	    		'content' => 'Este es mi cuarto mensaje!',
	    		'image' => 'http://placeimg.com/600/338/any?4'
    		]
    	];	
	    return view('welcome',[
	    	'messages' => $messages
	    ]);
    } //home

}
