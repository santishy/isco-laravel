<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\SectionCollection;

class ItemProductsController extends Controller
{
    public function index(){
      return new SectionCollection(\Session::get('item-products'));
    }

}
