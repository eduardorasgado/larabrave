@extends("layouts.app")

@section('content')
   <div class="jumbotron text-center" id="main_jumbo">
       <h1 id="main_title">Larabrave</h1>
       <h5>La comunidad mas grande de escritores en latinoamérica</h5> 
        <h4 id="main-phrase">¿Sobre qué leeremos hoy?</h4>
   </div>

   <!--formulario-->
   <div class="row md-4">
        <!--multipart/form-data es importante para subir los archivos al server-->
       <form class="" action="{{ url('/messages/create') }}" method="POST" enctype="multipart/form-data">
        <div class="row form-group">
          
          {{-- funcion que provee laravel para generar un token --}}
          {{-- Sin ello, el form no es reconocido por laravel --}}
          {{ csrf_field() }}

          <div class="col-sm-7">
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

         <div class="col-sm-2">
            <div class="custom-file">
              {{--Input del file--}}
              <input class="custom-file-input bg-success" id="customFile" type="file" name="image">
              <label class="custom-file-label" for="customFile">Imagen</label>          
            </div>
         </div>
         <div class="col-sm-1">
           <button type="submit" class="btn btn-primary">Publicar</button>
         </div>

        </div>
     </form>
   </div>

   <div class="row">
        
    @forelse($messages as $message)
     <div class="col-md-6">
       @include('messages.message')
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
