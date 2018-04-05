<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Broadcast;

class BroadcastServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Broadcast::routes();

        //Seguir la direccion para ver que en verdad
        //channels contiene la App.Users usado en el
        //echo del componente Notifications de vue
        require base_path('routes/channels.php');
    }
}
