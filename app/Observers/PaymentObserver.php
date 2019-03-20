<?php

namespace App\Observers;

use App\Payment;
use App\ShoppingCart;
use App\Remision;

class PaymentObserver
{
    /**
     * Handle the payment "created" event.
     *
     * @param  \App\Payment  $payment
     * @return void
     */
    public function created(Payment $payment)
    {
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

    /**
     * Handle the payment "updated" event.
     *
     * @param  \App\Payment  $payment
     * @return void
     */
    public function updated(Payment $payment)
    {
        //
    }

    /**
     * Handle the payment "deleted" event.
     *
     * @param  \App\Payment  $payment
     * @return void
     */
    public function deleted(Payment $payment)
    {
        //
    }

    /**
     * Handle the payment "restored" event.
     *
     * @param  \App\Payment  $payment
     * @return void
     */
    public function restored(Payment $payment)
    {
        //
    }

    /**
     * Handle the payment "force deleted" event.
     *
     * @param  \App\Payment  $payment
     * @return void
     */
    public function forceDeleted(Payment $payment)
    {
        //
    }
}
