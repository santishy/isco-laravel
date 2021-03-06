<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//use Artisaninweb\SoapWrapper\SoapWrapper;
use App\Soap;
use App\Articulo;
use App\Section;
use App\Brand;
use App\Serie;
use App\Line;
use App\Inventory;
use App\Events\ClickArticle;
use Artisaninweb\SoapWrapper\SoapWrapper;
use App\Http\Resources\ProductsCollection;
use Validator;
use App\Jobs\UpdatingWebservice;
use Illuminate\Support\Facades\Cache;

class ArticlesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $webservice = new Soap(new SoapWrapper);
        $data = collect($webservice->consume());
        Articulo::where('id_articulo','>','0')->update(['id_utilidad' => 0]);
        Section::where('id_seccion','>',0)->update(['status' => 0]);
        Line::where('id_linea','>',0)->update(['status' => 0]);
        Brand::where('id_marca','>',0)->update(['status' => 0]);
        Serie::where('id','>',0)->update(['status' => 0]);
        //cache::forever('data',$data);
// comentar esta linea
        //$webservice->obtenerListaArticulos();
// descomentar estas otras
        foreach($data->chunk(400) as $chunk)
        {

          UpdatingWebservice::dispatch($chunk);
        }
        return "Actualizado";
    }
    public function cache(){

        dd(cache::get('data','hola'));
    }
    public function obtenerParidad(){
        $webservice=new Soap(new SoapWrapper);
        return $webservice->obtenerParidad();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function searching(Request $request){
        //$request->flash();
        $products=[];
        if($request->wantsJson()){
          $products=Articulo::search($request->word)->with('brand')->paginate(20);
          return new ProductsCollection($products);
        }
        $ruta = url('/search');
        $method = 'GET';
        return view('search.products',['products'=>$products,'method'=>$method,'ruta'=>$ruta]);
    }
    public function create()
    {

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
    public function show(Request $request,$id)
    {
        $article=Articulo::with(['inventario'])->find($id);
        //cuando se remisionaba estaban estas lineas d codigo--------------------------------
        // $price=$article->price();
        // if($article->proveedor=='pchmayoreo')
        // {
        //     $extension=$article->extension;
        //     $webservice=new Soap(new SoapWrapper);
        //     $article=$webservice->ObtenerArticulo($article->sku);
        //     if(!$article->estatus)
        //         return view('articles.agotado');
        //     $article->datos->extension=$extension;
        //     $article=$article->datos;
        // }
        // $article->price=$price;
        //cuando se remisionaba estaban estas lineas d codigo fin del bloque--------------------------------
        $price=$article->precio;
        $article->price=$price;
        event(new ClickArticle($article,$request->ip())); // CONTAR LOS CLICKS
        return view('articles.article',['article'=>$article,
                                        'price'=>$price,'id_articulo'=>$id]);
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

        $article = Articulo::find($id);
        $messages=['image'=>'El :attribute tiene que ser una imagen',
                    'dimensions'=>'Las dimensiones de :attribute tienen que ser de 3200 x 800 width-height','required'=>'El :attribute es un campo requerido'];
        $validator=Validator::make(['image'=>$request->file('image')],[
            'image'=>['image','required','dimensions:width>200,height>200'],
            ],$messages);
        if(!$validator->fails()){
            if($request->hasFile('image'))
                if($request->file('image')->isValid()){
                    $img = \Storage::disk('public')->putFileAs('images/imgsPCH',$request->file('image'),$article->sku.'.'.$request->image->extension());
                    //\Storage::setVisibility('sliders/'.$request->file('slider'),'public');
                    $article->extension = $request->image->extension();
                    $article->save();
                    return response()->Json(['success' => true]);
                }
                else dd('ultimo if');

                else
                    dd('no contiene imagen');
    } else
                dd($validator->errors());

     return redirect("/producto/$id");
}
    public function pdf(){
        $pdf = \PDF::loadView('pdf.prueba');
        return $pdf->download('invoice.pdf');
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
    function uploadImage(request $request){

    }

    public function images($fileName)
    {
    	$path= storage_path('app/images/'.$fileName);
      if(!\File::exists($path))
        {
            $fileName=strtoupper($fileName);
            $path= storage_path('app/images/'.$fileName);
        }
      if(!\File::exists($path))
        $path=storage_path('app/images/noimg.jpg');
        $file=\File::get($path); //leemos el archivo
        $mimeType=\File::mimeType($path);
        $response=\Response::make($file,200); //
        $response->header('Content-Type',$mimeType);
        return $response;
    }

}
