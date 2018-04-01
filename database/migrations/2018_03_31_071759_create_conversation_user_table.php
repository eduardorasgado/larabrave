<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConversationUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //Esta migracion crea la tabla intermedia 
        //Entre usuarios y conversacion
        //porque es uno a muchos 
        //una conversacion muchos usuarios
        Schema::create('conversation_user', function (Blueprint $table) {
            $table->integer('conversation_id')->unsigned();
            //un usuario debe existir una vez
            //en una conversacion
            $table->integer('user_id')->unsigned();
            //por tanto
            $table->primary(['conversation_id', 'user_id']);

            
            $table->foreign('conversation_id')->references('id')->on('conversations');

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
        Schema::dropIfExists('conversation_user');
    }
}
