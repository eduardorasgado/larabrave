<?php
/*
Esta migracion se creo via

php artisan make:migration add_created_at_index_to_messages_table --table messages

Y edita una tabla ya creada
*/
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCreatedAtIndexToMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //table, ya no es create, asume que 
        //la tabla ya existe
        Schema::table('messages', function (Blueprint $table) {
            //el nombre de la columna, el nombre alias para
            //ser borrado
            $table->index('created_at', 'messages_created_at_index');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //este schema no dice drop, porque no borrara la tabla
        //solo la modificara y regresara a su estado anterior
        Schema::table('messages', function (Blueprint $table) {
            //se toma nombre alias en up()
            //igual puede ser por convencion:
            //nombre tabla,nombre campo, nombre metodo
            $table->dropIndex('messages_created_at_index');
        });
    }
}

/*
Para volver atras el ultimo migration que hicimos:

    php artisan migrate:rollback

Para volver atras todas las migraciones que hicimos:

    php artisan migrate:reset

Para volver adelante las migraciones deshechas:

    php artisan migrate:refresh

*/