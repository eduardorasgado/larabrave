<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/*Tambien esto se modela en mensajes como hasmany

Modelo que trae a uso la tabla intermedia responses,
con el fin de conectar usuario-comentario-mensaje

En este modelo se hace la relacion entre llaves
foraneas y primarias de usuarios y mensajes

Notese que Message - Response hay relaciones del tipo hasMany y belongsTo, pero en el caso de
Response - User solo tenemos la referencia
en Response, aqui, y esto es porque Mensajes ya está relacionado con User y podemos jalar al user desde responses() en Message.php


*/
class Response extends Model
{
    //
    protected $guarded = [];

    public function user()
    {
    	//una respuesta tiene un usuario
    	return $this->belongsTo(User::class);
    }

    public function message()
    {
    	//una respuesta tiene un mensaje
    	return $this->belongsTo(Message::class);
    }
}
