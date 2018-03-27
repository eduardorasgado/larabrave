@extends("layouts.app")

@section('content')
   <div class="jumbotron text-center">
       <h1>Larabrave</h1>
       <nav>
           <ul class="nav nav-pills">
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/') }}">Inicio</a>
                </li>
                
           </ul>
       </nav>
   </div>

   <!--formulario-->
   <div class="row">
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
            <div class="col-6">
                <img class="img-thumbnail" src="{{ $message->image }}">
                <p class="card-text">{{ $message->content }} <a href="/messages/{{ $message->id }}">Leer mas</a></p>
            </div>
        @empty
        <p>Disculpa, algo salió mal, no hay contenido :(</p>
        @endforelse
   </div>
@endsection
