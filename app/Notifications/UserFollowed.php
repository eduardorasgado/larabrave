<?php
/*

Creado con 
php artisan make:notification UserFollowed

*/


namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
//importamos clase user porque la usamos aqui
//y no está en la misma direccion que este archivo
use App\User;

class UserFollowed extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    //necesarion traerla a propiedades publicas
    public $follower;

    public function __construct(User $follower)
    {
        //
        $this->follower = $follower;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    //Donde definimos por dopnde se notifica al user
    public function via($notifiable)
    {
        //via email y via database, para persistir las 
        //notificaciones usando la tabla notifications
        //migrada con php artisan notifications:tabla
        return ['mail', 'database'];
        //con meter database aqui laravel ya guarda los datos 
        //de la notificacion en la db
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */

    //como se va a enviar el email
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->subject('Larabrave | Tienes un nuevo seguidor!')
                    ->greeting('Hola '.$notifiable->name.'!')
                    ->line($this->follower->name.' te ha comenzado a seguir, no es genial? Que tal si hechas un vistazo a su perfil:')
                    ->action('Ver perfil de '.$this->follower->name, url('/'.$this->follower->username))
                    ->line('Genial! Escribe todo el contenido que quieras y compártelo con tus nuevos amigos.')
                    ->salutation('El equipo de Larabrave te saluda :)');

        //el container del mensaje customizado con 
        //los datos de laravel se editan en
        //config/app.php
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */

    //Como se va a convertir el mensaje a un array
    //para usarlo en la web, por ejemplo para
    //mandarlo al frontend
    public function toArray($notifiable)
    {
        /*
        Una vez que agregamos database al array de via()
        debemos retornar los datos de la notificacion a
        guardar para llenar
        el campo data en el item guardado en la DB

        en la DB:
        data: contiene al que dio follow
        notifiable_id: contiene el id del usuario seguido
        es decir, al que le llego la notificacion via email
        */
        return [
            'follower' => $this->follower,
        ];
    }
}
