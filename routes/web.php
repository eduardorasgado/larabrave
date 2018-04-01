<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!

Socialite y tinker fueron instalados con composer y agregados a config/app.php en providers y Socialite facades a aliases también

|
*/

//RUTAS
//--------------------------------------------------------------------
//Estas dos rutas fueron agregadas al hacer(Auth y home)
//php artisan make:auth
Auth::routes();

//Rutas de facebook
Route::get('/auth/facebook', 'SocialAuthController@facebook');

Route::get('auth/facebook/callback', 'SocialAuthController@callback');
//register con facebook
Route::post('/auth/facebook/register','SocialAuthController@register');

//-----------------------------------------------
//Busqueda
Route::get('/messages/search','MessagesController@search');
//--------------------------------------------------------------------

//con @ nos estamos refiriendo al metodo de la clase
//del controlador nombrado
Route::get('/', 'PagesController@home');
Route::get('/home', 'PagesController@home')->name('home');
//--------------------------------------------------------------------

//Post especifico
Route::get('/messages/{message}', 'MessagesController@show');


//--------------------------------------------------------------------

//grupo de filtrado
Route::group(['middleware' => 'auth'], function(){
	//Con el middleware podemos proteger la ruta
	Route::post('/messages/create', 'MessagesController@create');

	//Envio de mensaje privado
	Route::post('/{username}/dms','UsersController@sendPrivateMessage');

	//Es posible crear un controller p/conversations
	Route::get('/conversations/{conversation}','UsersController@showConversation');
	
	////para la accion de seguir
	Route::post('/{username}/follow','UsersController@follow');

	//dejar de seguir
	Route::post('/{username}/unfollow','UsersController@unfollow');


});
//------------------------------------------------------------------

//mostrar usuario especifico, y sus mensajes
Route::get('/{username}', 'UsersController@show');

//lleva a la pagina de siguiendo a
Route::get('/{username}/follows', 'UsersController@follows');

//lleva a la pagina de seguidores
Route::get('/{username}/followers', 'UsersController@followers');

//--------------------------------------------------------------------
//Hay un bug en:
// '/index'