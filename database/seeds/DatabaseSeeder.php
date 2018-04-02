<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	//propuesta de laravel de como organizar 
    	//seeders
        // $this->call(UsersTableSeeder::class);

        //mandamos a ejecutar
        //volvemos a ejecutar la query generadora
        //que se uso en el ejemplo en UserFactory con tinker

        //Crear 50 fake users 
        $users = factory(App\User::class)
        ->times(50)
        //y para cada user crear 20 mensajes
        ->create();

        //funcion anonima que hace algo por cada user
        $users->each(function(App\User $user) use ($users)
        {
            $messages = factory(App\Message::class)
            ->times(20)
            ->create([
                //Este array es el user_id 
                //Así cada mensaje estara vinculado
                //A su creador
                'user_id' => $user->id,
            ]); //crear mensajes

            $messages->each(function (App\Message $message) use ($users){
                //para cada mensaje crearles comentarios
                //entre uno y diez comentarios
                factory(App\Response::class, random_int(1,10))
                        ->create([
                            'message_id' => $message->id,
                            //dame al asar un user
                            'user_id' => $users->random(1)->first()->id,
                        ]); //agregar comentarios a mensaje
            });
            //accede al metodo ejecutandolo para
            //poder modificar los campos del user
            $user->follows()->sync(
                //random es una propiedad especial de users
                $users->random(10)
            ); //agregar seguidores a cada usuario
        });

        
    }
}
/*
Para ejecutar el seeder:
	
	php artisan db:seed

	--------------------------------

Si ya creamos antes una n cantidad de datos en la db y queremos hacer un nuevo seeding, podemos borrar todos los datos de la DB y volver a hacer el seed

php artisan migrate:refresh --seed


O:
php artisan migrate:fresh
php artisan migrate:rollback
php artisan migrate
php artisan db:seed

*/