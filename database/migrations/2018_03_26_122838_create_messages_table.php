<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
/*
Las migraciones son creadas con artisan

    php artisan make:migration --help

Donde podemos notar que creamos una migracion
para creacion de tabla de la manera siguiente:
    
    php artisan make:migration nombre_de_migracion --create nombre_de_tabla

Luego en esta migracion .php podemos editar
los parametros de la tabla que seran incluidos
como columnas

Una vez editado podemos realizar la migracion:
    
    php artisan migrate

Si sale error 42000 max lenght, se acude a hacer cambios a:

/app/Porviders/AppServiceProvider.php

Si sale otro error de already exits, ejecutar:
    
    php artisan migrate:fresh

OJO: En .env debemos de checar bien los datos
de la DB, user,password,host,port
para poder hacer la migracion y laravel acceda a la
DB

*/
class CreateMessagesTable extends Migration
{
    /**
     * Run the migrations.
     Con el metodo up cualquier punto de las migraciones puede avanzar
     COn el metodo down podemos retroceder en las migraciones,
     Asi no hay restricciones en las migraciones y tenemos control de ellas
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->increments('id');
            //Esta peticion o metodo de table devuelve
            //a la DB la creacion de created_at y updated_at
            //Solicitados por el ORM Eloquent
            $table->timestamps();

            $table->string('content');
            $table->string('image');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('messages');
    }
}
