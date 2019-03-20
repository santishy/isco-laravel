<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Line;

class LinesController extends Controller
{
    public function index(){
    	$limit=Line::count();
    	$lines=Line::skip(15)->take($limit);
    	return response()->JSON(['lines'=>$lines->get()]);
    }
    function products($id){
    	$line=Line::find($id);
    	$products=$line->products()->paginate(25);
    	return view('lines.products',['products'=>$products]);
    }

}
