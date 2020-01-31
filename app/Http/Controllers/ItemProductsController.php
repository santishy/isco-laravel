<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ItemProductsController extends Controller
{
    public function index(){
      return response()->json(['data' => \Session::get('item-products')]);
    }
}
