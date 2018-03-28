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

        //Extraccion de numero de palabras por mensaje
        $mess_words_array =  [];
        foreach ($messages as $message) {
            # code...
            $mess_words = 1;
            $mess = $message->content;
            $m_length = strlen($mess)-1;
            foreach (range(0,$m_length) as $i) 
            {
                if ($mess[$i] == ' ')
                {
                    $mess_words ++;
                }
            }
            $mess_words_array[$message->id] = $mess_words;
        }	

	    return view('welcome',[
	    	'messages' => $messages,
            'words' => $mess_words_array,
	    ]);
    } //home

}
