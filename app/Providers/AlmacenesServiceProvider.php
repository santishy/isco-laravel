<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AlmacenesServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {

        view()->composer('articles.article',function($view){
            $almacenes=['1'=>'Guadalajara','16'=>'Monterrey','7'=>'DF','56'=>'Puebla',
                        '21'=>'Merida','74'=>'Leon'];
            $view->with('almacenes',$almacenes);
        });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
