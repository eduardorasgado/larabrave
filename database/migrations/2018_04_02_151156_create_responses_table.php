<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResponsesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('responses', function (Blueprint $table) {
            //id propio de la respuesta
            $table->increments('id');
            //llaves foraneas de la tabla 
            //mensaje(post) al que pertenece
            $table->integer('message_id')->unsigned();
            //usuario que comenta
            $table->integer('user_id')->unsigned();
            //mensaje del usuario 
            $table->string('message');
            //fecha de creacion y actializado
            $table->timestamps();

            //seteando llaves foraneas
            $table->foreign('message_id')->references('id')->on('messages');
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
        Schema::dropIfExists('responses');
    }
}
