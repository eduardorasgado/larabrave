<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;


class ExampleTest extends TestCase
{
    /**
     * A basic test example.

     Aplicacion del test en consola:

        ./vendor/bin/phpunit

     *
     * @return void
     */
    public function testBasicTest()
    {
        //Pasos del test:
        //Arrange | preparacion
        // Act | Accion
        //Assert | Verificacion

        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee('Larabrave');
    }

    //Estos metodos tienen que iniciar con la 
    //palabra test para ser reconocido por phpunit
    public function testCanSearchForMessages()
    {
        //test de busqueda, recordar que debemos evitar
        //los test incorporando nuestras apps de terceros
        //como Algolia
        $response = $this->get('/messages/search?query=Alice');
        $response->assertSee('Alice');
    }
}
