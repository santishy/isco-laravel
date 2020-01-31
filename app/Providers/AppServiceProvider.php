<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Section;
use App\Brand;
use App\Line;
use App\Payment;
use Illuminate\Support\Facades\Session;
use App\Utility;
use Validator;
use App\Serie;
use App\Articulo;
use App\Observers\PaymentObserver;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //Schema::defaultStringLength(191);
        Payment::observe(PaymentObserver::class);

        Validator::extend('createUtility', function ($attribute, $value, $parameters, $validator) {
            $categoria = $value;
            if(!Utility::where([['desde','<=',$parameters[0]],
                                ['hasta','>=',$parameters[0]],
                                ['categoria',$categoria]])->exists())
               return !Utility::where([['desde','<=',$parameters[1]],
                                ['hasta','>=',$parameters[1]],
                                ['categoria',$categoria]])->exists();
            return false;


            });
        Validator::extend('updateUtility',function($attribute,$value,$parameters,$validator){
           $categoria = $value;
            if(!Utility::where([['desde','<=',$parameters[0]],
                                ['hasta','>=',$parameters[0]],
                                ['id_utilidad','!=',$parameters[2]],
                                ['categoria',$categoria]])->exists())
               return !Utility::where([['desde','<=',$parameters[1]],
                                ['hasta','>=',$parameters[1]],
                                 ['id_utilidad','!=',$parameters[2]],
                                ['categoria',$categoria]])->exists();
            return false;
        });
        Validator::extend('createProduct',function ($attribute, $value, $parameters, $validator) {
            if(!Articulo::where('skuFabricante','=',$value)->where('proveedor','=',$parameters[0])->exists())
                return true;
            return false;
        });
        view()->composer('*',function($view){
            $secciones=Section::orderBy('seccion','asc')->where('status','=',1)->get();
            $marcas=Brand::orderBy('marca','asc')->where('status','=',1)->get();
            $vars['productsCount']=
            $vars['secciones']=$secciones;
            \Session::put('item-products',$secciones);
            $vars['marcas']=$marcas;
            $vars['lineas']=Line::orderBy('linea','asc')->get();
            $vars['lines']=Line::limit(10);
            $vars['series']=Serie::orderBy('name','asc')->get();
            $vars['products']=Section::limit(10);
            $view->with('vars',$vars);
              /*$shopping_cart_id=\Session::get('shopping_cart_id');
              $shopping_cart=ShoppingCart::findBySessionShoppingCart($shopping_cart_id);
              \Session::put('shopping_cart_id',$shopping_cart_id);*/
      });

    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

    }
}
