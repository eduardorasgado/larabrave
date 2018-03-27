@extends("layouts.app")

@section('title')
	Mensaje | Larabrave
@endsection

@section('content')
	@if ($message)
		<h1 class="h3">Id del mensaje: {{ $message->id }}</h1>
		<img class="img-thumbnail" src="{{ $message->image }}">
		<p class="card-text">{{ $message->content }}
		<small class="text-muted"> {{ $message->created_at }}</small></p>
	@else
		Ops.. algo ocurrió, intentalo mas tarde
	@endif
	<a href="{{ url('/') }}"><button class="btn btn-secondary">Regresar</button></a>
	
@endsection