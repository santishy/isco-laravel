<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SectionLineProducts extends Controller
{
    public function index(){
      $products=Articulo::with('utilidade')->where('id_linea',$id_linea)->where('id_seccion',\Session::get('id_seccion'))->where('activo','=',1)->orderBy('precio','asc')->paginate(20);
      $ruta = url()->full();
      $method = 'GET';
      if($request->wantsJson())
          return new ProductsCollection($products);
    }
}
