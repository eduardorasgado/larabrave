<?php

namespace App;
//modelo de perfil de facebook
use Illuminate\Database\Eloquent\Model;

class SocialProfile extends Model
{
    //
    protected $guarded = [];

    public function user()
    {
    	//una red pertenece a un usuario
    	return $this->belongsTo(User::class);
    }

}
