@extends('layouts.app')
@section('title')
	{{ $user->name }} | Larabrave
@endsection
@section('content')
	<h1>{{ $user->name }}</h1>
	<br>
	<a href="{{ url('/') }}"><button class="btn btn-outline-secondary">Regresar</button></a>
	<br><br>
	{{--Mostrando todos los mensajes accediendo a la propiedad hasMany en User.php--}}
	<div class="row">
		@foreach($user_mess as $message)
			<div class="col-6">
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