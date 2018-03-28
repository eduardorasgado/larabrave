<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUserIdColumnToMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('messages', function (Blueprint $table) {
            //
            $table->integer('user_id')->unsigned();

            $table->foreign('user_id')->references('id')->on('users');
        });
        //Para que esto funcione debemos de primero borrar todas la bases de datos:
        //php artisan migrate:reset
        //y luego hacer las migraciones
        //php artisan migrate
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('messages', function (Blueprint $table) {
            //nombre tabla, nombre columna, nombre de peticion
            $table->dropForeign('messages_user_id_foreign');
            $table->dropColumn('user_id');
        });
    }
}
