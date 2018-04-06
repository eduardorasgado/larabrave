<?php

namespace App\Http\Controllers;

/*
COnfigurado gracias a Socialite
la url debe estar en https por facebook
recurrimos a developers.facebook.com para hacer la API
de login con facebook
LA URL:
//debe estar en https e igual q en developers
        //facebook, http lo podemos conseguir con
        //ngrok en localhost en desarrollo
ver config/services.php

*/

use Illuminate\Http\Request;
use Socialite; //de aliases facades en config/app.php
use App\User;
use App\SocialProfile;

class SocialAuthController extends Controller
{
    //
    public function facebook()
    {
    	//redireccioname a facebook
    	return Socialite::driver('facebook')
    			->redirect();
    }

    public function callback()
    {
    	//Si ya volviste dame los datos que
    	//traes de facebook
    	$user = Socialite::driver('facebook')
    			->user();

    	//Le dice al modelo->metodo socialProfiles
    	//Que si tiene al menos una red social
    	//me devuelva el resultde la funcion
    			//AUN PODEMOS MEJORAR RENDIMIENTO
    			//VER COMENTARIO EN LOGIN CON FACEBOOK
    	$existing = User::whereHas('socialProfiles', function($query) use ($user){
    		//Si hay un id en la DB con el id
    		//de facebook
    		$query->where('social_id',$user->id);
    	})->first();

    	if ($existing != null){
    		auth()->login($existing);
    		return redirect('/');
    	}

    	//session es funcion de laravel, flash es un metodo
    	//para guardar datos temporalmente en session
    	session()->flash('facebookUser', $user);

    	return view('users.facebook',[
    		'user' => $user,
    	]);
    }

    public function register(Request $request)
    {
    	$data = session('facebookUser');

    	//input cuando extraemos de Request
    	$username = $request->input('username');

    	$user = User::create([
    		//vienen de facebook
    		'name' => $data->name,
    		'email' => $data->email,
    		'avatar' => $data->avatar,
    		'username' => $username,
    		//el password es random porque
    		//el login es con facebook
    		'password' => str_random(16),
    	]);

    	$profile = SocialProfile::create([
    		//viene de facebook
    		'social_id' => $data->id,
    		//viene del usuario q se creo en la 
    		//tabla users
    		'user_id' => $user->id,
    	]);

    	//hacer login del usuario recién creado
    	auth()->login($user);

    	return redirect('/');
    }

}
