<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Message;
use App\Http\Requests\CreateMessageRequest;

class MessagesController extends Controller
{
    public function show(Message $message)  //puede haber un $id
    {
    	//Ir a buscar el message por ID
    	//Una view de un message

    	//Message $message
    	//Crea una query que busca el la DB el elemento directamente
    	//Si no existe devuelve un error de
    	//NOtFoundHttpException o 404

    	//$message = Message::find($id);
        $words = [];
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
        $words[$message->id] = $mess_words;  
    	
        //messages es carpeta,show es archivo
    	return view('messages.show', [
    		'message' => $message,
            'words' =>$words,
    	]);
    } //show

    public function create(CreateMessageRequest $request){



    	//Responde al post, y debe de haber en el form de la view
    	//una impresion de un token csrf_field()

    	//La validacion aqui
    	//Se encuentra en app/Http/Request\CreateMessageRequest
    	//Y se creo con artisan

        $user = $request->user();
        $image = $request->file('image');

    	$message = Message::create([
    		'content' => $request->input('message'),
            //va al archivo filesystems
            //y se hace un php artisan storage:link
    		'image' => $image->store('messages', 'public'),
            'user_id' => $user->id,
    	]);

    	//dd($message);


    	return redirect('/messages/'.$message->id);

    } //create
}
