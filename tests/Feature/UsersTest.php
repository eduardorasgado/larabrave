<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\User;
//Debemos traerla a mano
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\Concerns\InteractsWithDatabase;

//Todas las clases de test se conocen como test Suit

//el nombre de la clase de un test debe terminar con la palabra test
class UsersTest extends TestCase
{
	//Con esta funcion damos un rollback a los datos 
	//metidos en la base de datos por el tester
	use DatabaseTransactions;

	//threat que permite preguntar a la DB por cambios
	use InteractsWithDatabase;

	public function testCanSeeUserPage()
	{
		//Crea un usuario faker
		$user = factory(User::class)->create();
		//trae la pagina del usuario
		$response = $this->get('/'.$user->username);
		//comprueba su ve el nombre en la view
		$response->assertSee($user->name);
	}

	public function testCanLogin()
	{
		$user = factory(User::class)->create();
		$response= $this->post('/login',[
			'email' => $user->email,
			'password' => 'secret',
		]);

		//comprobar si hubo una autentificacion
		$this->assertAuthenticatedAs($user);
	}

	public function testCanFollow()
	{
		$user = factory(User::class)->create();
		$other = factory(User::class)->create();

		//actingAs loguea en el test al user para poder seguir
		//y no tener que sobrecrear un test ya hecho como
		//en testCanLogin
		$response = $this->actingAs($user)->post($other->username.'/follow');

		//interactuando con la BD para verificar relacion
		//en tabla followers con columnas user_id y followed_id
		$this->assertDatabaseHas('followers', [
			'user_id' => $user->id,
			'followed_id'=> $other->id,
		]);

	}
}