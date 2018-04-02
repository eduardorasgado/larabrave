<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

//Tambien esto se modela en mensajes como hasmany
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
