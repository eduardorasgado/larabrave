@extends("layouts.app")

@section('content')
   <div class="jumbotron text-center">
       <h1>Larabrave</h1>
   </div>

   <!--formulario-->
   <div class="row md-4">
       <form class="" action="{{ url('/messages/create') }}" method="POST">
        <div class="form-group">
          
          {{-- funcion que provee laravel para generar un token --}}
          {{-- Sin ello, el form no es reconocido por laravel --}}
          {{ csrf_field() }}

          <!--is-invalid es una clase de bootstrap-->
          <input class="form-control @if($errors->has('message')) is-invalid @endif" type="text" name="message" placeholder="Qué estás pensando?" maxlength="160" size="80">  

          @if($errors->has('message'))
            {{-- NOs dará todos los errores relacionados al message --}}
            @foreach($errors->get('message') as $error)
              <!-- invalid-feedback tambien es de bootstrap-->
              <div class="invalid-feedback">{{ $error }}</div>
            @endforeach
          @endif

        </div>
     </form>
   </div>

   <div class="row">
        
        @forelse($messages as $message)
            <!--div class="col-6">
                <img class="img-thumbnail" src="{ $message->image }}">
                <p class="card-text">{ $message->content }} <a href="/messages/{ $message->id }}">Leer mas</a></p>
            </div-->

            <div class="col-6">
          <div class="card mb-4 box-shadow">
            <img class="card-img-top" src="{{ $message->image }}" alt="Card image cap">
            <div class="card-body">
              <p class="card-text">{{ $message->content }}</p>
              <div class="d-flex justify-content-between align-items-center">
                <div class="btn-group">
                  <a href="/messages/{{ $message->id }}"><button type="button" class="btn btn-sm btn-outline-secondary">Leer mas</button></a>
                </div>
                <small class="text-muted">{{ strlen($message->content) }} letras</small>
              </div>
            </div>
          </div>
        </div>

        @empty
        <p>Disculpa, algo salió mal, no hay contenido :(</p>
        @endforelse

        {{-- Para la paginacion de la web, tomando los datos de paginate()--}}
        @if(count($messages))
          <!--margin top y margin x en class-->
          <div class="mt-2 mx-auto">
            {{ $messages->links('pagination::bootstrap-4')}}
          </div>
        @endif
   </div>
@endsection
