<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Brand;
use App\Http\Resources\ProductsCollection;

class BrandProductsController extends Controller
{
  public function index(Brand $brand){
    $articles=$brand->articles()->paginate(15);
    if(request()->wantsJson())
        return new ProductsCollection($articles);
    return view('admin.brands.products',['id' => $brand->id_marca]);
  }


}
