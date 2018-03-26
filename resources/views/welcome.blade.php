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

   <div class="row">
        @forelse($messages as $message)
            <div class="col-6">
                <img class="img-thumbnail" src="{{ $message['image'] }}">
                <p class="card-text">{{ $message['content'] }} <a href="/messages/{{ $message['id'] }}">Leer mas</a></p>
            </div>
        @empty
        <p>Disculpa, algo salió mal, no hay contenido :(</p>
        @endforelse
   </div>
@endsection
