<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUsernameAndAvatarToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            //
            $table->string('username',190)->unique();
            $table->string('avatar')->nullable();
            //190 dado que al parecer no podemos meter
            //255 caracteres
            //y despues en vez de migrate normal,asi
            //php artisan migrate
            //hacemos
            //para volver a cargar las tablas y cargar de nuevo los datos de prueba:
            //php artisan migrate:refresh --seed
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            //
            $table->dropColumn('username');
            $table->dropColumn('avatar');
        });
    }
}
