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
          &nbsp;&nbsp;&nbsp;
          <p class="text-muted mt-1">Publicado por <a href="/{{ $message->user->username }}" id="name_link">{{ $message->user->name }}</a></p>
        </div>
        <small class="text-muted">{{ $words[$message->id] }} palabras</small>
      </div>
    </div>
  </div>
</div>