<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Section;
use App\Serie;
use App\Articulo;
use App\Http\Resources\ProductsCollection;
class SectionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $name='productos';
    protected $url='productos/';
    protected $method=null;
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function articles(Request $request,$id){   
        \Session::put('id_seccion',$id);
        $section=Section::with(['lines','series','articles'])->find($id);
        $series=$section->series;
        $articles=$section->articles()->orderBy('precio','asc')->paginate(20);
        if($request->isJson()){
           
            return response()->json(new ProductsCollection($articles));
        }
        $lines=$section->lines;
        $this->method = "GET";
        $route = url()->full();
        return view('sections.articles',['products'=>$articles,
                                            'series'=>$series,
                                            'name'=>$this->name,
                                            'lines'=>$lines,
                                            'url'=>$this->url,
                                            'ruta' => $route,
                                            'method' => $this->method]);
    }
    public function series(Request $request)
    {
        $section=Section::with(['lines','series'])->find(\Session::get('id_seccion'));
        $products=$section->seriesProducts($request);
        $ruta = url()->full();
        if($request->wantsJson())
             return new ProductsCollection($products->get());
        $array=$request->except('_token');
        $series=$section->series;
        $lines=$section->lines;
        $method = "POST";
        return view('sections.articles',['products'=>$products->orderBy('precio','asc')->paginate(16),
                                            'series'=>$series,
                                            'name'=>$this->name,
                                            'lines'=>$lines,'array'=>$array,
                                            'url'=>$this->url,
                                            'ruta'=>$ruta,
                                            'method' => $method]);
    }
    public function listProducts(){
        $limit=Section::count();
        $products=Section::skip(15)->take($limit);
        return response()->JSON(['products'=>$products->get()]);
    }
    public function productsLine(Request $request,$id_linea){
        $section=Section::with(['lines','series'])->find(\Session::get('id_seccion'));
        $lines=$section->lines;
        $series=$section->series;
        $products=Articulo::with('utilidade')->where('id_linea',$id_linea)->where('id_seccion',\Session::get('id_seccion'))->where('activo','=',1)->orderBy('precio','asc')->paginate(16);
        $ruta = url()->full();
        $method = 'GET';
        if($request->wantsJson())
            return new ProductsCollection($products);
        return view('sections.articles',['products'=>$products,'url'=>$this->url,'lines'=>$lines,'series'=>$series,'ruta'=>$ruta,
            'method' => $method]);
    }
}
