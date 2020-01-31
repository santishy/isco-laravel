<?php

namespace App\Http\Controllers;

use App\Section;
use Illuminate\Http\Request;
use App\Http\Resources\ProductsCollection;

class SectionProductsController extends Controller
{
    public function index(Section $section){
      if(request()->wantsJson()){
        $products = $section->articles()->with('brand')->orderBy('precio','asc')->paginate(20);
        return response()->json(new ProductsCollection($products));
      }
      return view('admin.sections.products',['id' => $section->id_seccion]);
    }
}
