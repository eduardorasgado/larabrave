<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    //fillable, solo estos campos se pueden rellenar
    protected $fillable = [
        'name','username', 'email', 'password','avatar'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function messages() 
    {
        //buscar desde este modelo a otro modelo
        //1 a muchos 
        return $this->hasMany(Message::class)->orderBy('created_at', 'desc');
    }
}
