@extends('layouts.app')

@section('title')
	Búsqueda | Larabrave
@endsection

@section('content')
	<div class="row">
		@forelse($messages as $message)
			<div class="col-6">
				@include('messages.message')
			</div>
		@empty
			<h2>Al parecer no hay rastro de lo que buscas, que tal si pruebas con otros temas</h2>
		@endforelse
	</div>
@endsection