@extends("layouts.app")

@section('title')
	Mensaje | Larabrave
@endsection

@section('content')
	<a href="@if(url()->previous() != Request::url()) {{ url()->previous() }} @else / @endif"><button class="btn btn-outline-secondary">Regresar</button></a>
	<br><br>
	@if ($message)
		<div class="col-6">
			<h1 class="h3">Id del mensaje: {{ $message->id }}</h1>
			@include('messages.message')
		</div>
	@else
		Ops.. algo ocurrió, intentalo mas tarde
	@endif
<!--Implementacion de VueJs-->
<responses></responses>
@endsection