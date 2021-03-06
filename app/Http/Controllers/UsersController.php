<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Conversation;
use App\PrivateMessage;
use App\Notifications\UserFollowed;

class UsersController extends Controller
{
    //
    public function show($username)
    {   
        //para comprobar proteccion contra error 500
        //throw new \Exception("Error!!");

    	$user = $this->findByUsername($username);

        //recurrir metodo de modelo Users
    	$messages = $user->messages;
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

        $user_mess = $user->messages()->paginate(10);

    	return view('users.show',[
    		'user' => $user,
    		'user_mess' => $user_mess,
    		'words' => $mess_words_array,
    	]);
    }

    public function follow($username, Request $request)
    {
    	//a quien seguire
    	$user = $this->findByUsername($username);

    	//dar usuario logueado(yo)
    	$me = $request->user();

        if ($me->id != $user->id)
        {
                //incluir a quien seguire en mi campo
            //modificar algun dato: con follows()
            $me->follows()->attach($user);

            //Funciona porque use Notifiable ya esta desde
            //la creacion del proyecto, en el model User
            //hacemos la notificacion (app/Notifications/UserFollowed)
            //Solamente incluimos al usuario logueado $me
            $user->notify(new UserFollowed($me));
            //Al $user notificale que $me lo sigue

            //llevar al usuario que estamos siguiendo
            return redirect("/$username")
                    ->withSuccess("Ahora sigues a $user->name");
        }
    	else
        {
            return redirect("/$username")
                    ->withSuccess("Ops! No puedes seguirte a ti mismo.");
        }
    	
    }

    public function unfollow($username, Request $request)
    {
    	//a quien dejare de seguir
    	$user = $this->findByUsername($username);

    	//dar usuario logueado(yo)
    	$me = $request->user();
    	
    	//incluir a quien deseguire en mi campo
    	$me->follows()->detach($user);

    	//llevar al usuario que estamos siguiendo
    	return redirect("/$username")
    			->withSuccess("Ahora ya no sigues a $user->name");
    }

    public function follows($username)
    {
    	$user = $this->findByUsername($username);

    	return view('users.follows',[
    		'user' => $user,
    	]);
    }

    public function followers($username)
    {
    	$user = $this->findByUsername($username);

    	return view('users.followers',[
    		'user' => $user,
    	]);
    }

    public function sendPrivateMessage($username, Request $request)
    {
        $userTo = $this->findByUsername($username);
        $userLogged = $request->user();
        $message = $request->input("message");

        //tengo ya una conversación?

        //metodo estatico que no existe pero que
        //creamos a mano
        //verifica existencia y crea o manda conversacion
        //incluyendo ya a los usuarios involucrados
        $conversation = Conversation::between($userLogged, $userTo);


        //Se manda mensaje privado
        $privateMessage = PrivateMessage::create([
            'user_id' => $userLogged->id,
            'message' => $message,
            'conversation_id' => $conversation->id,
        ]);

        //ruta creada y añadida a web.php
        return redirect('/conversations/'.$conversation->id);
    }

    public function showConversation(Conversation $conversation)
    {
        //Este metodo funciona porque en el modelo
        //conversation hay un belog}ngsToMany y por
        //las llaves foraneas dentro de las tablas
        //private_message y conversation_user

        //precargar metodos del model Conversation
        $conversation->load('users', 'privateMessages');
        //dd($conversation);

        //user actual
        $user = auth()->user()->id;
        //users en la conversacion menos el actual
        $other = $conversation->users->except($user);

        //Si hay uno en la conversacion
        //que significa que el que trata de acceder
        //si esta en la conversacion
        if(count($other) < 2){
            return view('users.conversation',[
            'conversation' => $conversation,
            //usuario logueado
            'user' => auth()->user(),
            ]);
        }
        //Si al final aun hay dos en la conversacion
        //es decir, el que accede no es parte de ella
        else{
            return redirect('/');
        }
   
    }

    private function findByUsername($username)
    {
        //metodo FirstOrFail siempre devuelve un usuario y si
        //no lo encuentra da una excepcion tipo not found
        return User::where('username',$username)->firstOrFail();
    }

    public function notifications(Request $request)
    {
        return $request->user()->notifications;
    }

}
