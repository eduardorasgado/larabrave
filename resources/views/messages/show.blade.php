@extends("layouts.app")

@section('title')
	Mensaje | Larabrave
@endsection

@section('content')
	<a href="@if(url()->previous() != Request::url()) {{ url()->previous() }} @else / @endif"><button class="btn btn-outline-secondary">Regresar</button></a>
	<br><br>
	@if ($message)
		<div class="col-md-6">
			<h1 class="h3">Id del mensaje: {{ $message->id }}</h1>
			@include('messages.message')

			<!--Implementacion Responses de VueJs haciendo echo con blade mandando el id de mensaje-->
			<!--Como props al componente vue-->
				<responses :message="{{ $message->id }}"></responses>
		</div>
	@else
		Ops.. algo ocurrió, intentalo mas tarde
	@endif
@endsection