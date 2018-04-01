@extends("layouts.app")

@section('title')
	Mensajes | Larabrave
@endsection

@section('content')
	{{--excepts filtra e implode(propiedad_interna_de_objeto, separador_interno) convierte una coleccion a un string--}}
	<h1 id="h-name">Conversación con {{ $conversation->users->except($user->id)->implode('name',', ') }}</h1>

	<div class="jumbotron">
		@foreach($conversation->privateMessages as $message)
			<div class="card">
				<div class="card-header">
					{{ $message->user->name }} dijo...
				</div>
					<div class="row">
						<div class="col-1">
						</div>
						
						<div class=" card-block col-6">
								{{ $message->message }}	
						</div>
						<div class="footer text-muted small">
							{{ $message->created_at }}
						</div>				
					</div>
				</div>
		@endforeach
	</div>
	
	
@endsection