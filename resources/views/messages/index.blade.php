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
	@if(count($messages))
        <!--margin top y margin x en class-->
        <div class="mt-2 mx-auto">
        	{{--Incluir query en todo el paginado--}}
          {{ $messages->appends(['query' => $query])->links('pagination::bootstrap-4')}}
         </div>
    @endif
@endsection