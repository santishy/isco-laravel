<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Articulo;
use App\Line;
use App\Click;
use App\Slider;
use App\Http\Resources\Product;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
   public function index(Request $request)
    {
        if($request->wantsJson()){
          $data = array();
          foreach(Click::mostVisited() as $click){
            array_push($data,new Product($click->articulo));
          }
          return $data;
        }
        $sliders=Slider::orderBy('id','desc')->limit(3)->get()->take(3);
        $articles = Articulo::with('utilidade')->where('id_utilidad','!=',0)->orderBy('visits','desc')->limit(12)->get();
        return view('home/index',['articles'=>$articles,'sliders'=>$sliders]);
    }
}
