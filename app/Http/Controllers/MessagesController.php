<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Message;
use App\Http\Requests\CreateMessageRequest;

class MessagesController extends Controller
{
    public function show(Message $message)  //puede haber un $id
    {
    	//Ir a buscar el message por ID
    	//Una view de un message

    	//Message $message
    	//Crea una query que busca el la DB el elemento directamente
    	//Si no existe devuelve un error de
    	//NOtFoundHttpException o 404

    	//$message = Message::find($id);
        $words = $this->countWords([$message]);

        //messages es carpeta,show es archivo
    	return view('messages.show', [
    		'message' => $message,
            'words' =>$words,
    	]);
    } //show

    public function create(CreateMessageRequest $request){



    	//Responde al post, y debe de haber en el form de la view
    	//una impresion de un token csrf_field()

    	//La validacion aqui
    	//Se encuentra en app/Http/Request\CreateMessageRequest
    	//Y se creo con artisan

        $user = $request->user();
        $image = $request->file('image');

        if(!$image){
            $image = '';
        }
        else{
            $image->store('messages', 'public');
        }

    	$message = Message::create([
    		'content' => $request->input('message'),
            //va al archivo filesystems y se corrobora
            //y se tiene que hacer un php artisan storage:link
    		'image' => $image,
            'user_id' => $user->id,
    	]);

    	//dd($message);


    	return redirect('/messages/'.$message->id);

    } //create

    public function search(Request $request)
    {
        $query = $request->input('query');

        //BUsqueda en la BD tabla messages y columna content
        //LIKE: BUscar parecidos, %$quey% significa que en 
        //cualquier parte del mensaje estara el contenido
        //buscado
        //COn with bajamos el numero de querys en la consola
        //al abrir la view, las precargamos
        
        //$messages = Message::with('user')->where('content', 'LIKE', "%$query%")->paginate(10);

        //Busqueda usando Algolia y Lravel Scout
        $messages = Message::search($query)->paginate(10);

        //precargar usuarios antes de la view
        //with es cuando cargas una query
        //load es cuando ya tienes una query
        $messages->load('user');

        //conteo de palabras por mensaje
        $words = $this->countWords($messages);

        return view('messages.index', [
            'messages' => $messages,
            'words' => $words,
            //pasando la query para el paginado
            'query' => $query,
        ]);
    }

    private function countWords($messages)
    {
        $mess_words_array =  [];
        foreach ($messages as $message) {
            # code...
            $mess_words = 1;
            $mess = $message->content;
            $m_length = strlen($mess)-1;
            foreach (range(0,$m_length) as $i) 
            {
                if ($mess[$i] == ' ')
                {
                    $mess_words ++;
                }
            }
            $mess_words_array[$message->id] = $mess_words;
        }
        return $mess_words_array;   
    }
}
