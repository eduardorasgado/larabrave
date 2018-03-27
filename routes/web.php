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

Route::get('/messages/{message}', 'MessagesController@show');

Route::post('/messages/create', 'MessagesController@create');

//Estas dos rutas fueron agregadas al hacer
//php artisan make:auth
Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');
