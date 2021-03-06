
<div class="card mb-4 box-shadow">
  {{--funcion que apunta a tomar la url interna del proyecto ubicada en .env(la base o host) y unirla a la url del archivo en la carpeta mostrada en config/filesystems.php mas el nombre del archivo a subir--}}
  @if($message->image != '')
    <img class="card-img-top" src="{{ $message->image }}" alt="Card image cap">
  @endif
  <div class="card-body">
    <small class="text-muted float-right">{{ $message->created_at }}</small>
    <br>
    <p class="card-text">{{ $message->content }}</p>
    <div class="d-flex justify-content-between align-items-center">
      <div class="btn-group">
        <a href="/messages/{{ $message->id }}"><button type="button" class="btn btn-sm btn-outline-secondary">Leer mas</button></a>
        &nbsp;&nbsp;&nbsp;
        <p class="text-muted mt-1">Publicado por <a href="/{{ $message->user->username }}" id="name_link">{{ $message->user->name }}</a></p>
      </div>
      <small class="text-muted">{{ $words[$message->id] }} palabras</small>
    </div>
  </div>
</div>
