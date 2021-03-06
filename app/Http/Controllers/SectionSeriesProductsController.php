<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Section;
use App\Http\Resources\ProductsCollection;

class SectionSeriesProductsController extends Controller
{
    public function index(Request $request){
      $section = Section::find($request->section_id);
      $products = $section->seriesProducts($request)->get();
      return response()->json(new ProductsCollection($products));
    }
}
