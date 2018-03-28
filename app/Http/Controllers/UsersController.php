<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UsersController extends Controller
{
    //
    public function show($username)
    {
    	$user = User::where('username',$username)->first();

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
}
