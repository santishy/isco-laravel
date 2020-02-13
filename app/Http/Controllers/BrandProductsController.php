<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Brand;
use App\Http\Resources\ProductsCollection;

class BrandProductsController extends Controller
{
  public function index(Brand $brand){
      // $brand=Brand::find($id);
      // $series=$brand->series;
      // $lines=$brand->lines()->get();
      $articles=$brand->articles()->paginate(15);
      if(request()->wantsJson())
          return new ProductsCollection($articles);
      return view('admin.brands.products',['id' => $brand->id_marca]);
    //return response()->json(['data' => \Session::get('brand-products')]);
  }


}
