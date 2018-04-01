<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\PrivateMessage;
use App\User;

class Conversation extends Model
{
    //
    public function users()
    {
    	//relacion entre cada conversación y los usuarios que
    	//participan de ella(mucho a muchos)
    	return $this->belongsToMany(User::class);
    }

    public function privateMessages()
    {
    	//uno a muchos
    	return $this->hasMany(PrivateMessage::class)->orderBy('created_at', 'desc');
    }

    public static function between(User $user,User $other )
    {
    	//busca la conversacion donde tenga ambos users 
    	$query = Conversation::whereHas('users', function ($query) use ($user){
    		$query->where('user_id', $user->id);
    	})
    	->whereHas('users',function($query) use ($other){
    		$query->where('user_id',$other->id);
    	});

    	//Recibe una array con atributos, si existe
    	//la conversacion, la devuelve, si no la crea 
    	$conversation = $query->firstOrCreate([]);

    	$conversation->users()->sync([
    		//sync garantiza que los usuarios
    		//esten en la conversacion
    		$user->id,
    		$other->id,
    	]);

    	return $conversation;
    }
}
