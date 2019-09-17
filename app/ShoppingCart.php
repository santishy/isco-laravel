<?php
namespace App;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use nusoap_client;
class ShoppingCart extends Model
{
	protected $table='shopping_carts';
	protected $fillable=['status'];
	public static function findBySessionShoppingCart($shopping_cart_id)
    {
      if($shopping_cart_id)
      //buscar el carrito de compras con esta sesion
        return ShoppingCart::findBySession($shopping_cart_id);
      else
        //crear un carrito de compras
        return ShoppingCart::createWithoutSession();
    }
    public static function findBySession($shopping_cart_id)
    {
      return ShoppingCart::find($shopping_cart_id);
    }
    public static function createWithoutSession()
    {
      return ShoppingCart::create(['status'=>'incompleted']);
    }
    public function inShoppingCart()
    {
    	return $this->hasMany('App\inShoppingCart','shopping_cart_id','id');

    }
	public function productsCount()
	{
		return $this->hasMany('App\InShoppingCart','shopping_cart_id','id')
				->addSelect(DB::raw('SUM(qty) as cantidad'));
	}
    // public function scopeArticulos($query)
    // {
    //     $query = DB::table('articulos')
    //         ->join('in_shopping_carts','articulos.id_articulo',
    //         '=','in_shopping_carts.id_articulo')
    //         ->join('shopping_carts','in_shopping_carts.shopping_cart_id',
    //         '=','shopping_carts.id')
    //         ->join('utilidades','utilidades.id_utilidad','=','articulos.id_utilidad')
    //         ->where('shopping_carts.id','=',$this->id)
    //         ->select('in_shopping_carts.*','articulos.*','shopping_carts.*');
    //     return $query->addSelect(DB::raw('in_shopping_carts.id as in_shopping_cart_id,
    //                             precioMasUtilidad(articulos.precio,utilidades.ut) as precioUtilidad'))
    //                  ->orderBy('moneda','asc');
    // }
    public function articulos(){
        return $this->belongsToMany('App\Articulo','in_shopping_carts','shopping_cart_id','id_articulo')->withPivot('qty','price');
    }
    public function BelongsToManyArticulos()
    {
        return $this->belongsToMany('App\Articulo','in_shopping_carts','shopping_cart_id','id_articulo')
                    ->addSelect('articulos.*','in_shopping_carts.*');
    }
	public function scopeMonedaMexicana($query)
    {
        return $query->where('moneda','=','MN');
    }
    public function totalMN($products){
        $total=0;
        foreach ($products as $product) {
            $total+=($product->price()*$product->qty);
        }
        return $total;
    }
    public function total()
    {
        $total=0;
        foreach($this->belongsToManyArticulos()->get() as $articulo)
        {
            $total+=$articulo->price*$articulo->qty;
        }
        return $total;
    }
    public function amount(){
         return $this->belongsToMany('App\Articulo','in_shopping_carts','shopping_cart_id','id_articulo')->sum('precio');
    }
    public function approve()
    {
        $this->updateCustomIdAndStatus();
    }
    public function genereteCustomId()
    {
        return md5($this->id.''.$this->updated_at);
    }
    public function updateCustomIdAndStatus()
    {
        $this->status='Aprobado';
        $this->customid=$this->genereteCustomId();
        $this->save();
    }
    public function order()
    {
        return $this->hasOne('App\Order','shopping_cart_id','id')->first();
    }
	public function separateCurrency()
	{
		$articlesCurrency=array();
		$MN=$this->belongsToManyArticulos()->where('moneda','=','MN')->orderBy('almacen','asc')->get();
        $USD=$this->belongsToManyArticulos()->where('moneda','=','USD')->orderBy('almacen','asc')->get();
		if(count($MN)>0)
			array_push($articlesCurrency,array('articles'=>$MN,'moneda'=>'MN'));
		if(count($USD)>0)
			array_push($articlesCurrency,array('articles'=>$USD,'moneda'=>'USD'));
		return $articlesCurrency;
	}
	public function separateWarehouses($shoppingCartArticles){
		$almacenes=Inventory::all();
        $pch=array();
		for($i=0;$i<count($shoppingCartArticles);$i++)
	        foreach($almacenes as $almacen)
	        {
	            $articulosCant=array();
	            $remision=new Remision();
	            foreach($shoppingCartArticles[$i]['articles'] as $articulo)
	                if($almacen->almacen==$articulo->almacen)
	                        array_push($articulosCant,array('strSku'=>$articulo->sku,'iCantidad'=>$articulo->qty));
	            if(!empty($articulosCant))
	                array_push($pch,array('articulosCant'=>$articulosCant,'moneda'=>$shoppingCartArticles[$i]['moneda'],'almacen'=>$almacen->almacen));
	        }
        return $pch;
	}
}
