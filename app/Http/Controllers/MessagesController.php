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

    	//messages es carpeta,show es archivo
    	return view('messages.show', [
    		'message' => $message
    	]);
    } //show

    public function create(CreateMessageRequest $request){



    	//Responde al post, y debe de haber en el form de la view
    	//una impresion de un token csrf_field()

    	//La validacion aqui
    	//Se encuentra en app/Http/Request\CreateMessageRequest
    	//Y se creo con artisan

        $user = $request->user();

    	$message = Message::create([
    		'content' => $request->input('message'),
    		'image' => 'http://placeimg.com/600/338/any?'.mt_rand(0,1000),
            'user_id' => $user->id,
    	]);

    	//dd($message);


    	return redirect('/messages/'.$message->id);

    } //create
}
