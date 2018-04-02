@extends("layouts.app")

@section('title')
	Mensajes | Larabrave
@endsection

@section('content')
	<a href="{{ url()->previous() }}"><button class="btn btn-outline-secondary">Regresar</button></a>
	{{--excepts filtra e implode(propiedad_interna_de_objeto, separador_interno) convierte una coleccion a un string--}}
	<h1 id="h-name">Conversación con {{ $conversation->users->except($user->id)->implode('name',', ') }}</h1>

	<div class="jumbotron">
		@foreach($conversation->privateMessages as $privmessage)
			<div class="card">
				<div class="card-header">
					{{ $privmessage->user->name }} dijo...
				</div>
					<div class="row">
						<div class="col-1">
						</div>
						
						<div class=" card-body col-6">
								{{ $privmessage->message }}	
						</div>
						<div class="footer text-muted small">
							{{ $privmessage->created_at }}
						</div>				
					</div>
				</div>
		@endforeach
	</div>
	
	
@endsection