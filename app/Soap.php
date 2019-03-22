<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Dolar;
use App\Articulo;

//use App\Detinvart;
use App\Brand;
use App\Inventory;
use App\Serie;
use App\Detinvart;
use Carbon\Carbon;
use App\Remision;
use Laravel\Scout\Searchable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
// use Artisaninweb\SoapWrapper\Facades\SoapWrapper;
use Artisaninweb\SoapWrapper\SoapWrapper;

class Soap extends Model
{
    //
    public $param = array('cliente' =>6722,'llave' => '112012');
    protected $soapWrapper;
    protected $items;
    use Searchable;
 /**
  * SoapController constructor.
  *
  * @param SoapWrapper $soapWrapper
  */
  public function searchableAs()
    {
        return 'articulos';
    }
    function __construct(SoapWrapper $soapWrapper)
    {
        set_time_limit ( -1 );
        $this->soapWrapper=$soapWrapper;
        $this->soapWrapper->add('pch',function ($service) {
        $service

        ->wsdl('http://serviciosmayoristas.pchmayoreo.com/servidor.php?wsdl')
        ->trace(true);
      });
    }
    function  obtenerListaArticulos()
    {
         set_time_limit ( -1 );
        // Using the added service
        Detinvart::emptyStock();
        Articulo::desactivar();
        $param=$this->param;
        $webservice=$this->soapWrapper->call('pch.ObtenerListaArticulos', $this->param);
        //dd($webservice->datos);
        return $this->updateDB($webservice->datos);
    }
    function consume(){
      Detinvart::emptyStock();
      Articulo::desactivar();
      $param=$this->param;
      $webservice=$this->soapWrapper->call('pch.ObtenerListaArticulos', $this->param);
      //dd($webservice->datos);
      return $webservice->datos;
    }
    public function  obtenerParidad(){
        $param=$this->param;
           $response=$this->soapWrapper->call('ObtenerParidad', $this->param);
            if(strlen($response->datos)>0){
                $dolar=Dolar::find(1);
                if(empty($dolar))
                    $dolar=new Dolar;
                $dolar->precio=$response->datos;
                return $dolar->save();
            }
            else
                return $response->mensaje;
    }
     public function updateDB($items)
    {
        ini_set('max_execution_time', -1);
        $dolar=Dolar::priceDolar();
        $i=0;
        $items = collect($items);
        foreach($items->chunk(300) as $chunk)
        {
          foreach ($chunk as $item) {
            // code...
            if($item->moneda=='USD'){
                $item->moneda='MN';
                $item->precio=$item->precio*$dolar;
            }
            $brand=Brand::firstOrCreate(['marca'=>$item->marca]);
            $line=Line::firstOrCreate(['linea'=>$item->linea]);
            $serie=Serie::firstOrCreate(['name'=>$item->serie]);
            $section=Section::firstOrCreate(['seccion'=>$item->seccion]);
            $product = Articulo::firstOrNew(['sku'=>$item->sku]);
            $product->proveedor='pchmayoreo';
            $product->sku=$item->sku;
            $product->descripcion=$item->descripcion;
            $product->id_serie=$serie->id;
            $product->skuFabricante=$item->skuFabricante;
            $product->id_marca=$brand->id_marca;
            $product->id_seccion=$section->id_seccion;
            $product->id_linea=$line->id_linea;
            $product->moneda=$item->moneda;
            $product->activo=1;
            $product->precio=$item->precio;
            $product->save();
            /*hasta aqui articulo guardado--------------------------------------*/
            $data['article']=$product;
            $data['categoria']=$item->seccion;
            $data['precio']=$item->precio;
            $utilidad=$this->addUtilidad($data);
            $inventario=Inventory::updateOrCreate(['almacen'=>$item->inventario[0]->almacen]);
            $detinvart=Detinvart::updateOrCreate(['id_articulo'=>$product->id_articulo],['id_inventario'=>$inventario->id_inventario],$item->inventario[0]->existencia);

          }
        }
       dd('Actualizado');
    }
    public static function updating($items)
    {
      foreach ($items as $item) {
        // code...
        if($item->moneda=='USD'){
            $item->moneda='MN';
            $item->precio=$item->precio*$dolar;
        }
        $brand=Brand::firstOrCreate(['marca'=>$item->marca]);
        $line=Line::firstOrCreate(['linea'=>$item->linea]);
        $serie=Serie::firstOrCreate(['name'=>$item->serie]);
        $section=Section::firstOrCreate(['seccion'=>$item->seccion]);
        $product = Articulo::firstOrNew(['sku'=>$item->sku]);
        $product->proveedor='pchmayoreo';
        $product->sku=$item->sku;
        $product->descripcion=$item->descripcion;
        $product->id_serie=$serie->id;
        $product->skuFabricante=$item->skuFabricante;
        $product->id_marca=$brand->id_marca;
        $product->id_seccion=$section->id_seccion;
        $product->id_linea=$line->id_linea;
        $product->moneda=$item->moneda;
        $product->activo=1;
        $product->precio=$item->precio;
        $product->save();
        /*hasta aqui articulo guardado--------------------------------------*/
        $data['article']=$product;
        $data['categoria']=$item->seccion;
        $data['precio']=$item->precio;
        $utilidad=Soap::addUtilidad($data);
        $inventario=Inventory::updateOrCreate(['almacen'=>$item->inventario[0]->almacen]);
        $detinvart=Detinvart::updateOrCreate(['id_articulo'=>$product->id_articulo],['id_inventario'=>$inventario->id_inventario],$item->inventario[0]->existencia);

      }
      return;
    }
    public static function addUtilidad($data)
    {
        $utilidad=Utility::where('hasta','>=',$data['precio'])
                            ->where('desde','<=',$data['precio'])
                            ->where('categoria','=',$data['categoria'])
                            ->first();
        if($utilidad != null)//if(count($utilidad)>0)
        {
            $data['article']->id_utilidad=$utilidad->id_utilidad;
            $data['article']->precio = $data['article']->price();
            $data['article']->save();
        }
        return $utilidad;
    }
    public function caracteres($cadena){
        $caracteres=array('""','"',"''","'");
        $cadena= str_replace($caracteres,'',$cadena);
        return $cadena;
    }
    public function ObtenerArticulo($sku)
    {
        $param=$this->param;
        $param['sku']=$sku;
        $article=$this->soapWrapper->call('pch.ObtenerArticulo', $param);

        // $service=$this->soapWrapper::service('pch', function ($service) use ($param) {
        //     //$article=$service->call('ObtenerArticulo', $this->param);
        // });
        //$article=$service->call('ObtenerArticulo', $param);
        return $article;
    }
    public function GenerarRemision($almacen,$moneda,$data)
    {
        $param=$this->param;
        $service=$this->soapWrapper::service('pch', function ($service) use ($param) {
            //$article=$service->call('ObtenerArticulo', $this->param);
        });
        try{
            $result = $service->call("GenerarRemision", array(
                6722,
                "112012",
                $almacen,
                $moneda,
                    $data,
                "0012code"
            ));
            return $result;
        }
        catch(Exception $ex)
        {
             print_r($ex->getMessage());
        }
    }
    public  function remisionar($cart)
    {
        $param=$this->param;
        // $service=$this->soapWrapper::service('pch', function ($service) use ($param) {
        // });
        $remisiones=array();
        for($i=0;$i<count($cart);$i++)
        {
            $response=$service->call('pch.GenerarRemision', array(
                    6722,
                    "112012",
                    $cart[$i]['almacen'],
                    $cart[$i]['moneda'],
                    $cart[$i]['articulosCant'],
                    "0012code"
            ));
            $remision=Remision::create([
                'almacen'=>$cart[$i]['almacen'],
                'moneda'=>$cart[$i]['moneda'],
                'mensaje'=>$response->mensaje,
                'status'=>$response->estatus,
                'remision'=>$response->datos
            ]);

            $remisiones[$i]=$remision;
        }
        return $remisiones;
    }
    public function dolar(){

    }
}
