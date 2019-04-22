<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ShoppingCart;
use Carbon\Carbon;


class PDFController extends Controller
{
    public function quotation(Request $request)
    {
    	$shopping_cart=ShoppingCart::findBySession(session('shopping_cart_id'));
    	$pdf=\PDF::LoadView('pdf.quotation',['shopping_cart'=>$shopping_cart,'fecha'=>Carbon::now()->toDateTimeString()]);
    	//dd($shopping_cart->belongsToManyArticulos()->get());
    	return $pdf->download('cotizacion_'.session('shopping_cart_id').'.pdf');
    }
}
