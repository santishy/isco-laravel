<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\InShoppingCart;
use App\Articulo;
class InShoppingCartsController extends Controller
{

    public function __construct()
    {
        $this->middleware('shoppingcart');
    }
    public function store(Request $request)
    {
        // if(!$request->qty < $request->existencia)
        // {
            $in_shopping_cart = InShoppingCart::where('id_articulo',$request->id_articulo)
                ->where('shopping_cart_id',$request->shopping_cart->id)->first();
            if($in_shopping_cart)
                {
                  $in_shopping_cart->qty += $request->qty;
                  $in_shopping_cart->save();
                }
                else
                  $in_shopping_cart=InShoppingCart::Create(['qty'=>$request->qty,'almacen'=>$request->almacen,
                                                    'id_articulo'=>$request->id_articulo,'price'=>
                                                $request->price,'shopping_cart_id'=>$request->shopping_cart->id]);
            return response()->JSON(['success'=>true,
                                     'productsCount'=>$request->shopping_cart->productsCount[0]->cantidad,
                                     'article'=>$in_shopping_cart->article,'inShoppingCart'=>$in_shopping_cart
                                 ]);
        // }
            return response()->JSON(['success'=>false]);
    }
    public function update(Request $request, $id)
    {
        $inShoppingCart=InShoppingCart::find($id);
        // obtener existencia de dicho articulo .. en detinvart
        if($request->name=='qty')
        {
            $id_articulo=$inShoppingCart->id_articulo;
            $articulo=Articulo::find($id_articulo);
            //dd([$id_articulo,$inShoppingCart->almacen]);
            $existencia=$articulo->detinvart($id_articulo,$inShoppingCart->almacen)->existencia;
            if($request->value > $existencia)
            {
                return response()->json([
                    'success'=>false,
                    'status'=>'500']);
            }
            else
            {
                $field=$request->name;
                $inShoppingCart->$field=$request->value;
                $inShoppingCart->save();
                return response()->json([
                    'success'=>true]);
            }
        }
       /* $field=$request->name;
        $inShoppingCart->$field=$request->value;
        $inShoppingCart->save();
        return $inShoppingCart->$field;*/  //CON ESTO FUNCIONA EL ESTE METODO BIEN
    }
    public function destroy($id)
    {
        $ban=inShoppingCart::destroy($id);
        return response()->json(['ban'=>$ban]);
    }
}
