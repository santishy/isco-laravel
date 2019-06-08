<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Articulo;
use App\Detinvart;
use App\Inventory;
use App\Utility;
use App\Http\Resources\Product;
use App\Http\Resources\ProductsCollection;
use Validator;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        if($request->wantsJson())
          return response()->json(new ProductsCollection( Articulo::where('activo',1)->orderBy('id_articulo','desc')->paginate(25)));
        return view('admin.products.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function create()
    // {
    //     return view('admin.products.create');    1
    // }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules=['descripcion'=>['required'],
                'skuFabricante'=>['required',"createProduct:$request->proveedor"],
                'id_marca'=>['required'],
                'id_seccion'=>['required','integer'],
                'id_linea'=>['required','integer'],
                'precio'=>['required','numeric'],
                'sku'=>['unique:articulos','required'],
                'proveedor'=>['required'],
                'id_serie'=>['required','integer'],
                'image'=>['required','image'],
                'existencia'=>['required']
                ];

        $messages=['unique'=>'El :attribute ya existe en la base de datos','required'=>'El campo  :attribute  requerido ','integer'=>'Error en :attribute, con el ID debe ser un entero','create_product'=>'Este :attribute ya existe con este mismo proveedor','numeric'=>'El campo :attribute debe ser un número','image'=>'El :attribute debe ser una imagen'];
        $validator = Validator::make($request->all(),$rules,$messages);

         if(!$validator->fails()){

            if($request->hasFile('image'))

                if($request->file('image')->isValid()){
                    $request->extension = $request->image->extension();
                    $existencia=$request->existencia;
                    $data = $request->except('image','_token','existencia');
                    $data['extension'] =  $request->extension ;
                    $product=Articulo::create($data);
// mejor agregar en el soap                    Utility::addUtilidad($product->toArray());
                    $inventory=Inventory::where('almacen',1)->first();
                    $dt = new Detinvart;
                    $dt->existencia=$existencia;
                    $dt->id_inventario=$inventory->id_inventario;
                    $dt->id_articulo = $product->id_articulo;
                    $dt->save();
                    \Storage::disk('public')->putFileAs('images/imgsPCH',$request->file('image'),$product->sku.''.$request->image->extension());
                }
        }
         return view('admin.products.create')->withErrors($validator);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Articulo::find($id);
        return new Product($product);
    }
    function anotherProvider(){
         $products = Articulo::with('section')->where('proveedor','!=','pchmayoreo');
         foreach ($products->get() as $product) {
            $utilidad=Utility::where('hasta','>=',$product->precio)
                            ->where('desde','<=',$product->precio)
                            ->where('categoria','=',$product->section()->first()->seccion)
                            ->first();
            if($utilidad != null)//if(count($utilidad)>0)
            {
                $product->id_utilidad=$utilidad->id_utilidad;
                $product->save();
            }

         }
        dd($products->get());
        return;
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
}
