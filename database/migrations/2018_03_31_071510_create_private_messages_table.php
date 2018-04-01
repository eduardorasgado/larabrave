<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePrivateMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     Tabla del mensaje privado entre dos usuarios

    MOdelo y migracion al mismo tiempo:
    php artisan make:model PrivateMessage --migration

     * @return void
     */
    public function up()
    {
        Schema::create('private_messages', function (Blueprint $table) {
            $table->increments('id'); //id propio
            //referencia a la conversacion a la
            //que pertenece
            $table->integer('conversation_id')->unsigned();
            //referencia al usuario que la escribio
            $table->integer('user_id')->unsigned();
            //texto
            $table->string('message');
            $table->timestamps();
            //referencia a conversations table
            $table->foreign('conversation_id')->references('id')->on('conversations');
            //referencia a users table
            $table->foreign('user_id')->references('id')->on('users');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('private_messages');
    }
}
