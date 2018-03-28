<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
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

Route::get('/{username}', 'UsersController@show');