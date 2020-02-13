<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Articulo;
use App\Http\Resources\ProductsCollection;

class SectionLineProductsController extends Controller
{
    public function index(Request $request){
      $products = Articulo::with('utilidade')
                  ->where('id_linea',$request->line_id)
                  ->where('id_seccion',$request->section_id)
                  ->where('activo','=',1)->orderBy('precio','asc');
      return $products->get();
      return new ProductsCollection($products);
    }
}
