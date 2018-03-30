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

    	
    	//modelo de perfil de facebook
    }
}
