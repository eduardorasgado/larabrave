<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/*
Creado con:
php artisan make:request CreateMessageRequest

*/

class CreateMessageRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        //Dejar pasar todas las peticiones
        //sin un filtro antes, por ahora
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'message' => ['required','max:160','min:10']
        ];
    }

    //Este metodo fue creado para los mensajes de
    //error customizables
    public function messages(){
        return [
            //aqui estan los mensajes customizables
            'message.required' => 'Piensa en algo, luego compártelo con tus amigos!',
            'message.max' => 'No puedes escribir mas de 160 caracteres!',
            'message.min' => 'Escribe algo pero no tan corto, mas de 10 caracteres estaría bien.'
        ];
    }
}
