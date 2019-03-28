<?php
namespace App;
use App\Dolar;
use App\InShoppingCart;
use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\Model;
use Artisaninweb\SoapWrapper\SoapWrapper;
use Illuminate\Support\Facades\DB;
class Articulo extends Model
{
    //
    use Searchable;
    protected $ip;
    protected $table="articulos";
    protected $primaryKey="id_articulo";
    protected $fillable=['proveedor','activo','sku','descripcion','skuFabricante','id_marca','id_serie','id_seccion','id_linea','moneda','precio'];
    public function searchableAs()
    {
        return 'articulos';
    }
    public static function desactivar(){
        return Articulo::where('id_articulo','>',0)
        ->update(['activo'=>0]);
    }
    public function paypalArticulo()
    {
    	return \PaypalPayment::item()
    			->setName($this->skuFabricante)
    			->setDescription($this->descripcion)
    			->setCurrency('USD')
    			->setQuantity($this->qty)
                ->setTax(0)
    			->setPrice(Dolar::Cambio($this->price));
    }
    public function scopeMonedas($query)
    {
        return $query->distinct();
    }
    public function inShoppingCartId(){
        return InShoppingCart::where('id_articulo',$this->id_articulo)->where('shopping_cart_id',session('shopping_cart_id'))->first()->id;
    }
    public function scopeMonedaMexicana($query)
    {
        return $query->where('moneda','=','MN');
    }
    public function scopeUSD($query)
    {
        return $query->where('moneda','=','USD');
    }
    public function scopePruebanueva($query)
	{
		return $query->select('id')->get();
	}
    public function precioUtilidad()// este se puede llamar desde arrriba sustituyendo el $this->price
    {
        return $this->join('utilidades','articulos.id_utilidad','=','utilidades.id_utilidad')
                ->where('articulos.id_articulo','=',$this->id_articulo)
                ->select('utilidad')
                ->addSelect(DB::raw('precioMasUtilidad(articulos.precio,utilidades.ut) as precioUtilidad'));
    }
    // public  function detinvart($id_articulo,$almacen)
    // {
    //     return $this->belongsToMany('App\Inventario','detinvart','id_articulo','id_inventario')
    //             ->where('almacen','=',$almacen)
    //             ->where('activo','=',1)
    //             ->select('existencia')->first();
    //             //CHECAR BIEN ESTA FUNCION, LAS LLAVES COMO SE ACOMODAN
    //             // CHECAR COMO PIDEN LAS COSAS, EN ESTE CASO PEDIRIA TODOS LOS
    //             //INVENTARIOS DND ESTA ESE ARTICULO
    //
    // }
    public function inventario()
    {
        /*return $this->join('detinvart','articulos.id_articulo','=','detinvart.id_articulo')
                ->join('inventario','inventario.id_inventario','=','inventario.id_inventario');*/
        return $this->belongsToMany('App\Inventory','detinvart','id_articulo','id_inventario')->withPivot('existencia');
    }
    // public static function desactivar($sku)
    // {
    //     $article=Articulo::find(1);
    //     if(count($article->get())>0)
    //     {
    //         dd($article);
    //         $article->activo=0;
    //         $article->save;
    //     }
    // }
    public function price()
    {
         if( is_null($this->utilidade))
            return 0;

        $price=$this->precio;

        //$price=$this->precio*1.16; solo esta linea usaba las otras cinco no, a excepcion del primer if
        $utilidad=(($this->utilidade->ut*$price)/100);
        $price=$price+$utilidad;
        $price=$price*1.16;
        return round($price);
    }
    public function utilidade()
    {
        return $this->belongsTo('App\Utility','id_utilidad','id_utilidad');
    }
    public function brand()
    {
        return $this->hasOne('App\Brand','id_articulo','id_marca');
    }
    // public function section()
    // {
    //     return $this->hasOne('App\Section','id_seccion','id_articulo');
    // }
    public function section(){
        return $this->belongsTo('App\Section','id_seccion','id_seccion');
    }
    public function serie()
    {
        return $this->belongsTo('App\Serie','id_serie','id');
    }
    public function numberFormat(){
        return number_format($this->price(),2);
    }
    public function image(){

        if($this->extension != null)
            return $this->localfile();
        else
            return $this->externalFile($this->sku);
    }
    public function localFile(){
         return "http://iscocomputadoras.com/storage/images/imgsPCH/".$this->sku.'.'.$this->extension;
    }
    public function externalFile($sku)
    {
         return "http://www.pchmayoreo.com/media/catalog/product/".substr($this->sku, 0,1)."/".substr($this->sku, 1,1)."/".$this->sku.".jpg";

    }
}
