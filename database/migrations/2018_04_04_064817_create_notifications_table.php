<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/*
MIgración creada con:
    php artisan notifications:table

para crear la tabla que guardará las notificaciones de 
nuestra aplicación, en la base de datos

NO se modifico nada abajo solo se migro en este caso:

    php artisan migrate

Para las notificaciones no se crea un controlador,
sino se usan las notificaciones dentro de app/Notifications
en este caso UserFollowed
*/

class CreateNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notifications', function (Blueprint $table) {
            //el id no es autonumerico, es generado
            //por laravel
            $table->uuid('id')->primary();
            //indica que clase es
            $table->string('type');
            //relacion con un objeto notificable
            $table->morphs('notifiable');
            //campo de texto data, que dentro
            //contiene un JSON con la serializacion
            //de los datos de la notif.
            $table->text('data');
            //nos dira que notificacion ya fue leida y que notificacion no
            $table->timestamp('read_at')->nullable();
            //created_at, updated_at
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('notifications');
    }
}
