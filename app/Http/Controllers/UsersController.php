<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UsersController extends Controller
{
    //
    public function show($username)
    {
    	$user = $this->findByUsername($username);

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
    	
    	//incluir a quien seguire en mi campo
    	//modificar algun dato: con follows()
    	$me->follows()->attach($user);

    	//llevar al usuario que estamos siguiendo
    	return redirect("/$username")
    			->withSuccess("Ahora sigues a $user->name");
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

    private function findByUsername($username)
    {
    	return User::where('username',$username)->first();
    }
}
