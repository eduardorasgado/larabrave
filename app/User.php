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

    public function follows()
    {
        return $this->belongsToMany(User::class, 'followers', 'user_id', 'followed_id');
        //tabla,foreign,related
        //Busca los otros usarios donde yo soy el user_id
        //y followed son los otros
    }

    public function followers()
    {
        return $this->belongsToMany(User::class,'followers', 'followed_id', 'user_id');
        //tabla, foreign, related
         //Busca los otros usarios donde yo soy el followed_id
        //y user_id son los otros
    }

    public function isFollowing(User $user)
    {
        //Estamos accediendo directamente a un método
        //interno de follows que es contains de la
        //relacion belongsToMany
        //traer algun dato: con follows
        return !$this->follows->contains($user);

    }

    public function socialProfiles()
    {
        //un usuario tiene muchos perfiles
        //pero el perfil pertenece solo a un usuario
        return $this->hasMany(SocialProfile::class);
    }

}
