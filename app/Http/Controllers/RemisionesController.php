<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RemisionesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('shoppingcart');
    }
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $shopping_cart=$request->shopping_cart;
        /*$shopping_cart_id=\Session::get('shopping_cart_id');
        $shopping_cart=ShoppingCart::findBySessionShoppingCart($shopping_cart_id);*/
        $monedas=$shopping_cart->articulos()->monedas()->get();
        dd($monedas);
        /*$MN=$shopping_cart->articulos()->MonedaMexicana()->get();
        $USD=$shopping_cart->articulos()->USD()->get();
        $MN=ShoppingCart::dividirAlmacenes($MN);
        $USD=ShoppingCart::dividirAlmacenes($USD);
        if(isset($USD[0]))
            {
                for($i=0;$i<count($USD);$i++)
                {
                    $shopping_cart->apartado($USD[$i]['almacen'],$USD[$i]['moneda'],$USD[$i]['carrito']);
                }
            }
             if(isset($MN[0]))
            {
                for($i=0;$i<count($MN);$i++)
                {
                    $response=$shopping_cart->apartado($MN[$i]['almacen'],$MN[$i]['moneda'],$MN[$i]['carrito']);
                }
            }
        dd($response);*/
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
