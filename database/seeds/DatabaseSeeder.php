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
        factory(App\Message::class)
        ->times(100)
        ->create();
    }
}
/*
Para ejecutar el seeder:
	
	php artisan db:seed

	--------------------------------

Si ya creamos antes una n cantidad de datos en la db y queremos hacer un nuevo seeding, podemos borrar todos los datos de la DB y volver a hacer el seed

php artisan migrate:refresh --seed

*/