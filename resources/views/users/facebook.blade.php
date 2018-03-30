@extends('layouts.app')

@section('title')
	Entrar con facebook | Larabrave
@endsection

@section('content')
	<div class="row">
		<div class="col-2">
			<a href="{{ url()->previous() }}"><button class="btn btn-outline-secondary">Regresar</button></a>
		</div>
	</div>
	<br>
	<form action="/auth/facebook/register" method="POST">
		{{ csrf_field() }}

		<div class="card">
			<div class="card-block">
				<img class="img-thumbnail" src="{{ $user->avatar }}">
			</div>	
			<div class="card-block">	
				<div class="form-group">
					<label for="name" class="form-control-label">Nombre</label>
					<input class="form-control" type="text" name="name" value="{{ $user->name }}" readonly >
				</div>

				<div class="form-group">
					<label for="email" class="form-control-label">Correo Electrónico</label>
					<input class="form-control" type="text" name="email" value="{{ $user->email }}" readonly >
				</div>

				<div class="form-group">
					<label for="username" class="form-control-label">Nombre de Usuario</label>
					<input class="form-control" type="text" name="username" value="{{ old('username') }}">
				</div>
			</div>
			<div class="card-footer">
				<button class="btn btn-primary" type="submit">
					Registrarse
				</button>
			</div>
		</div>
	</form>
@endsection