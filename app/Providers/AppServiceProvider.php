<?php

/*
Esto se agrego a mano por el error de maxlength
//42000 en la primera migrate

*/
namespace App\Providers;

//Esto se agrego a mano por el error de maxlength
//42000 en la primera migrate
use Illuminate\Support\ServiceProvider;

//Esto se agrego a mano por el error de arriba
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //Esto se agrego a mano por el error de arriba
        Schema::defaultStringLength(191);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
