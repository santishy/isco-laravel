<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Brand;
use App\Articulo;
use App\Serie;
use App\Http\Resources\ProductsCollection;

class BrandsController extends Controller
{
	protected $name='marca';
    protected $url='marca/';

    public function articles(Request $request,$id){
    	$brand=Brand::find($id);
        $series=$brand->series;
        $lines=$brand->lines()->get();
        $articles=$brand->articles()->paginate(15);
        if($request->wantsJson())
            return new ProductsCollection($articles);
        $ruta = url()->full();
        $method = 'GET';
        \Session::put('brand_id',$id);
        return view('sections.articles',['products'=>$articles,
                                        'series'=>$series,'name'=>$this->name,
                                        'lines'=>$lines,'url'=>$this->url,
                                        'ruta'=>$ruta,
                                        'method'=>$method]);
    }
     public function serie($id)
    {
        $brand=Brand::find(\Session::get('brand_id'));
        $series=$brand->series;
        $serie=Serie::find($id);
        $articles=$serie->articles()->orderBy('precio','asc')->paginate(15);
        return view('sections.articles',['products'=>$articles,
                                        'series'=>$series,
                                        'name'=>$this->name,'url'=>$this->url]);
    }
    public function brandLine(Request $request,$id_linea){

        $brand=Brand::with(['series'])->find(\Session::get('brand_id'));
        $lines=$brand->lines;
        $series=$brand->series;
        $products=Articulo::with('utilidade')->where('id_linea',$id_linea)->where('activo','=',1)->where('id_marca',\Session::get('brand_id'))->orderBy('precio','asc')->paginate(16);
        if($request->wantsJson())
            return new ProductsCollection($products);
        $ruta = url()->full();
        $method = 'GET';
        return view('sections.articles',['products'=>$products,'url'=>$this->url,'lines'=>$lines,'series'=>$series,
            'ruta'=>$ruta,
            'method'=>$method]);
    }
    public function series(Request $request)
    {
        $brand=Brand::with(['lines','series'])->find(\Session::get('brand_id'));
        $array=$request->except('_token');
        $series=$brand->series;
        $products=$brand->seriesProducts($request);
        $lines=$brand->lines;
        if($request->wantsJson())
            return new ProductsCollection($products->get());
        $ruta = url()->full();
        $method = 'POST';
        return view('sections.articles',['products'=>$products->orderBy('precio','asc')->paginate(16),
                                            'url'=>$this->url,
                                            'series'=>$series,
                                            'name'=>$this->name,
                                            'lines'=>$lines,'array'=>$array,
                                            'ruta'=>$ruta,
                                            'method'=>$method]);
    }
}
