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

//con @ nos estamos refiriendo al metodo de la clase
//del controlador nombrado
Route::get('/', 'PagesController@home');
Route::get('/home', 'PagesController@home')->name('home');

Route::get('/messages/{message}', 'MessagesController@show');

//Con el middleware podemos proteger la ruta
Route::post('/messages/create', 'MessagesController@create')->middleware('auth');

//Estas dos rutas fueron agregadas al hacer
//php artisan make:auth
Auth::routes();

//Rutas de facebook
Route::get('/auth/facebook', 'SocialAuthController@facebook');
Route::get('auth/facebook/callback', 'SocialAuthController@callback');

//mostrar usuario especifico
Route::get('/{username}', 'UsersController@show');

////para la accion de seguir
Route::post('/{username}/follow','UsersController@follow')->middleware('auth');

//lleva a la pagina de siguiendo a
Route::get('/{username}/follows', 'UsersController@follows');

//lleva a la pagina de seguidores
Route::get('/{username}/followers', 'UsersController@followers');

//dejarde seguir
Route::post('/{username}/unfollow','UsersController@unfollow')->middleware('auth');

//Hay un bug en:
// '/index'