<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\User;
//Debemos traerla a mano
use Illuminate\Foundation\Testing\DatabaseTransactions;

//Todas las clases de test se conocen como test Suit

//el nombre de la clase de un test debe terminar con la palabra test
class UsersTest extends TestCase
{
	//Con esta funcion damos un rollback a los datos 
	//metidos en la base de datos por el tester
	use DatabaseTransactions;

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
}