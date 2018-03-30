@extends('layouts.app')

@section('title')
	Siguiendo | Larabrave
@endsection

@section('content')
	<a href="/{{ $user->username }}"><button class="btn btn-outline-secondary">Regresar</button></a>
	@if(Auth::check() && (Auth::user()->name == $user->name ))
		<h4>Estás siguiendo a:</h4>
	@else
		<h4><a href="/{{ $user->username }}">{{ $user->name }}</a> está siguiendo a</h4>
	@endif
	<br>
	<div class="row">
		@forelse($user->follows as $follow)
			<div class="col-4">
				<li><img class="imgRedonda" src="{{ $follow->avatar }}">
					<a href="/{{ $follow->username }}">{{ $follow->name }}</a>
					<p class="text-muted">{{ $follow->username }}</p>
				</li>
				<br>
			</div>
		@empty
			@if(Auth::check() && (Auth::user()->name == $user->name ))
				Parece que aún no sigues a otros, inspírate con tus autores favoritos!
			@else
				{{ $user->name }} aún no sigue a otros.
			@endif
		@endforelse
	</div>
	
@endsection

