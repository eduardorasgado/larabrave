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
    	$creator = "EduardoRasgadoRuiz";

		$links = [
		     "https://laravel.com/docs" => "Documentación",
		"https://laracasts.com" => "Laracast",
		"https://laravel-news.com" => "Noticias",
		"https://forge.laravel.com" => "Forge",
		"https://github.com/laravel/laravel" => "GitHub",
		    ];
	    return view('welcome',[
	    	'links' => $links,
	    	'creator' => $creator
	    ]);
    } //home

    public function aboutUs()
    {
    	return view('about');
    } //abouUs
}
