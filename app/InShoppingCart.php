<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class InShoppingCart extends Model
{
    //
    protected $table='in_shopping_carts';
    protected $fillable=['qty','almacen','shopping_cart_id','price','id_articulo'];
    public $timestamps=false;
    public function shoppingCart()
    {
    	return $this->belongsTo('App\ShoppingCart','shopping_cart_id','id')
    	->first();
    }
    public function article()
    {
        return $this->belongsTo('App\Articulo','id_articulo','id_articulo')
                ->addSelect('articulos.id_articulo as id_articulo','articulos.sku','articulos.descripcion');
    }
}
