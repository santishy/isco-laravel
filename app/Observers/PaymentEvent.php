<?php
namespace App\Observers;
use App\ShoppingCart;
use App\Remision;
class PaymentEvent{

    public function created(Payment $payment){
        $shoppingCart=ShoppingCart::findBySessionShoppingCart(\Session::get('shopping_cart_id'));
        $articlesCurrency=$shoppingCart->separateCurrency();
        $pch=$shoppingCart->separateWarehouses($articlesCurrency);
        $webservice=new Soap(new SoapWrapper);
        $result=$webservice->remisionar($pch);
        for($i=0;$i<count($result);$i++)
        {
            Remision::create([
                        'remision'=>$result[$i]->remision,
                        'payment_id'=>$payment->id,
                        'status'=>$result[$i]->status,
                        'moneda'=>$result[$i]->moneda,
                        'almacen'=>$result[$i]->almacen,
                        'mensaje'=>$result[$i]->mensaje
                    ]);
        }
    }
}
