@extends("layouts.app")

@section('content')
   
  <!--video background-->
   <div class="view hm-white-light jarallax" data-jarallax='{"speed": 0.2}' data-jarallax-video="https://www.youtube.com/watch?v=dk9uNWPP7EA&list=PL7cdQfbJcOxP_Ii2ifE-8NXj_qP1Mzb7a">
            <div class="full-bg-img">
                <div class="container flex-center">
                    <!--aqui van letras-->
                      <div class="text-center" id="main_jumbo" style="color: white;">
                         <h1 id="main_title">Larabrave</h1>
                         <h5>La comunidad mas grande de escritores en latinoamérica</h5> 
                          <h4 id="main-phrase">¿Sobre qué leeremos hoy?</h4>
                      </div>
                  </div>
            </div>
    </div>
    <br>
            <!--video background-->

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
          <div class="col-sm-3">
            <div class="form-group">
    
               {{--Input de link--}}
                <input class="form-control" id="customFile" type="text" name="image" placeholder="http://link-de-imagen.jpg" size="80">
            </div>
          </div>

         <div class="col-sm-1">
           <button type="submit" class="btn btn-primary">Publicar</button>
           @if(session('success'))
            <span class="text-success">{{ session('success') }}</span>
           @endif
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
