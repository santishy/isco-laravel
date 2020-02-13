<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\BrandsCollection;

class ItemsBrandsController extends Controller
{
    public function index(){
        return new BrandsCollection(\Session::get('brand-products'));
    }
}
