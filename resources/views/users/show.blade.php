@extends('layouts.app')
@section('title')
	{{ $user->name }} | Larabrave

@endsection
@section('content')
	<img class="imgRedonda" src="{{ $user->avatar }}">
	<h1 id="h-name">{{ $user->name }}</h1>
	<div class="row">
		<div class="col-2">
			{{--Si el link anterior no es el mismo actual, regresar, si es el--}}
			{{--mismo: regresar a /--}}
			<a href="@if(url()->previous() != Request::url()) {{ url()->previous() }} @else / @endif"><button class="btn btn-outline-secondary">Regresar</button></a>
			
		</div>
		@if(Auth::check() && (Auth::user()->name == $user->name))
			<div class="col-1.5">
				<h4><a href="/{{ $user->username }}/followers"><button class="btn btn-outline-primary">Te siguen</button>
					<span class="badge badge-dark">{{ $user->followers->count() }}</span></h4>
				</a>
			</div>
		@else
			<div class="col-1.5">
				<h4><a href="/{{ $user->username }}/followers"><button class="btn btn-outline-primary">Le siguen</button>
					<span class="badge badge-dark">{{ $user->followers->count() }}</span></h4>
				</a>
			</div>
		@endif
		<div class="col-2">
			<h4><a href="/{{ $user->username }}/follows"><button class="btn btn-outline-primary">Siguiendo a</button>
				<span class="badge badge-dark">{{ $user->follows->count() }}</span></h4>
			</a>
		</div>
		{{--Si estamos logueados y seguimos a la persona--}}
		@if (Auth::check() && Auth::user()->isFollowing($user) && (Auth::user()->name != $user->name))
			<div class="col-2">
				<form action="/{{ $user->username }}/unfollow" method="POST">
					{{ csrf_field() }}
					<button class="btn btn-primary">Dejar de seguir</button>
					{{--Para mostrar mensaje de exito enviado solo en la vuelta de un pedido--}}
					@if(session('success'))
						<span class="text-success">{{ session('success') }}</span>
					@endif
				</form>
			</div>
			{{--Si la Gate me permite enviar mensajes privados--}}
			@if(Gate::allows('dms', $user))
				<div class="col-8">
					<form action="/{{ $user->username }}/dms" method="POST">
						{{ csrf_field() }}
						<input type="text" name="message" class="form-control">
						<button class="btn btn-outline-success" type="submit">Enviar</button>
					</form>
				</div>
			@endif
		{{--Si estamos logueados y no seguimos a la persona--}}
		@elseif(Auth::check() && (Auth::user()->name != $user->name))
				<div class="col-2">
				<form action="/{{ $user->username }}/follow" method="POST">
					{{ csrf_field() }}
					<button class="btn btn-primary">Seguir</button>
					{{--Para mostrar mensaje de exito enviado solo en la vuelta de un pedido--}}
					@if(session('success'))
						<span class="text-success">{{ session('success') }}</span>
					@endif
				</form>
			</div>
		@endif
	</div>
	<br><br>
	{{--Mostrando todos los mensajes accediendo a la propiedad hasMany en User.php--}}
	<div class="row">
		@foreach($user_mess as $message)
			<div class="col-md-6">
				@include('messages.message')
			</div>
		@endforeach
	</div>

	{{-- Para la paginacion de la web, tomando los datos de paginate()--}}
      @if(count($user_mess))
        <!--margin top y margin x en class-->
        <div class="mt-2 mx-auto">
          {{ $user_mess->links('pagination::bootstrap-4')}}
      </div>

    @endif

@endsection