<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFollowersTable extends Migration
{
    /**
     * Run the migrations.
     Creado con artisan 
     php artisan make:migration name --create followers

     *
     * @return void
     */
    public function up()
    {
        Schema::create('followers', function (Blueprint $table) {
            //creamos columnas
            $table->integer('user_id')->unsigned();
            $table->integer('followed_id')->unsigned();

            //las columnas seran llaves primarias dentro de la tabla
            $table->primary(['user_id', 'followed_id']);

            //las llaves primarias seran llaves foraneas en la tabla users
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('followed_id')->references('id')->on('users');

            //Ce crea fechado
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.

     con:

     php artisan migration:rollback
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('followers');
    }
}
