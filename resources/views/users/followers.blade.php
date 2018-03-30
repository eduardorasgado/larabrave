@extends('layouts.app')

@section('title')
	Seguidores | Larabrave
@endsection

@section('content')
	<a href="/{{ $user->username }}"><button class="btn btn-outline-secondary">Regresar</button></a>
	@if(Auth::check() && (Auth::user()->name == $user->name))
		<h4>Te siguen:</h4>
	@else
		<h4><a href="/{{ $user->username }}">{{ $user->name }}</a> es seguid@ por</h4>
	@endif
	<br>
	<div class="row">
		@forelse($user->followers as $wfollower)
			<div class="col-4">
				<li><img class="imgRedonda" src="{{ $wfollower->avatar }}">
					<a href="/{{ $wfollower->username }}">{{ $wfollower->name }}</a>
					<p class="text-muted">{{ $wfollower->username }}</p>
				</li>
				<br>
			</div>
		@empty
			@if(Auth::check() && (Auth::user()->name == $user->name ))
				Parece que aún no tienes mucha popularidad, a escribir!
			@else
				{{ $user->name }} aún no tiene seguidores :(
			@endif
		@endforelse
	</div>
	
@endsection

