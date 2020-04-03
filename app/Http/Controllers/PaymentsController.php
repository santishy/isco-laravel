<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\MercadoPago;
use App\ShoppingCart;
use App\Payment;
use App\Paypal;
use App\Order;
use App\Dolar;
use App\Events\Remision;
use App\libs\nusoap;
use App\CreditCard;
use App\Soap;
use Illuminate\Support\Facades\Session;
use Artisaninweb\SoapWrapper\Facades\SoapWrapper;


class PaymentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $shopping_cart=null;
    public function __construct()
    {
        $this->middleware('shoppingcart');
    }
    public function index()
    {
        //
    }
    public function create($shopping_cart_id)
    {
        $shopping_cart=ShoppingCart::findBySessionShoppingCart($shopping_cart_id);
        $this->shopping_cart=$shopping_cart;
        Session(['shopping_cart_id'=>$shopping_cart->id]);
        $products=$shopping_cart->articulos()->get();
        $envio=99;
        return view('payments.create',
                    ['shopping_cart'=>$shopping_cart,
                    'products'=>$products,
                    'envio'=>$envio]);
    }
    public function pay(Request $request){
      $amount = $request->shopping_cart->amount();
      switch ($request->payment_platform) {
        case 'paypal':
          $paypal = new Paypal();
          $payment = $paypal->generate($request->shopping_cart);
          return redirect($payment->getApprovalLink());
          break;
        case 'mercadopago':
          $mercadopago = new MercadoPago;
        //  dd($request->all());
          $mercadopago->handlePayment($request);
          break;
        default:
          // code...
          break;
      }
    }
    public function execute(Request $request){
        $paymentId = $request->paymentId;
        $paypal = new Paypal();
        $paypal->setAttributes($request);
        $payment = $paypal->execute();
        $paypalPayment = $payment;
        $payment = Payment::create(['forma_pago' =>  $paypalPayment->payer->payment_method,
                                     'paypal_payment_id' => $paypalPayment->id,
                                     'total' => $paypalPayment->transactions[0]->amount->total ]);

        $order = $request->shopping_cart->order();
        $order->id_pago = $payment->id_pago;
        $order->save();
    }


    // public function store(Request $request)
    // {
    //     $payment=Payment::create(['forma_pago'=>$request->forma_pago,'total'=>$request->total]);
    //     Session::put('id_pago',$payment->id);
    //     $shoppingCart=$request->shopping_cart;
    //     $articlesCurrency=$shoppingCart->separateCurrency();
    //     $pch=$shoppingCart->separateWarehouses($articlesCurrency);
    //     $webservice=new Soap(new SoapWrapper);
    //     $result=$webservice->remisionar($pch);
    //     if($request->forma_pago=='paypal')
    //         return $this->paypal($request);
    //     else
    //     {
    //         return $this->creditCard($request);
    //     }
    // }
    // public function paypal($request)
    // {
    //     $paypal=new Paypal($request);
    //     $payment=$paypal->generate();
    //     return redirect($payment->getApprovalLink([]));
    // }
    // public function creditCard($request)
    // {
    //     $shoppingCart=$request->shopping_cart;
    //     $paypal=new Paypal($request);
    //     $payment=$paypal->generate();
    //     if(!is_array($payment))
    //     {
    //         $payment=(array)$payment;
    //         $payment=$payment[key($payment)];
    //         $payment['error']=false;
    //         if($payment['state']=='approved')
    //         {
    //             $request=$request->toArray();
    //             $orderData=array_slice($request,9,count($request)-1);// datos de la orden
    //             Order::createFormPaypalResponse($orderData,$shoppingCart);
    //             $creditCardData=array_slice($request,1,8);// divido el form  tarjeta de credito
    //             CreditCard::storeCreditCard($creditCardData);
    //             //$dataOrder=array_slice($request,9,count($request)-1);// datos de la orden
    //         }
    //     }
    //     return response()->json($payment);
    // }
    // public function show($id)
    // {
    //     //
    // }

    // public function edit($id)
    // {
    //     //
    // }

    // /**
    //  * Update the specified resource in storage.
    //  *
    //  * @param  \Illuminate\Http\Request  $request
    //  * @param  int  $id
    //  * @return \Illuminate\Http\Response
    //  */
    // public function updateAndStore(Request $request)
    // {
    //     //$shopping_cart=ShoppingCart::findBySessionShoppingCart(\Session::get('shopping_cart_id'));
    //     $shopping_cart=$request->shopping_cart;
    //     $paypal=new Paypal($shopping_cart);
    //     $response = $paypal->execute($request->paymentId,$request->PayerID);
    //     if($response->state=='approved')
    //     {
    //         $shopping_cart->approve();
    //         $payer=$response->payer;
    //     	$orderData=(array) $payer->payer_info->shipping_address;
    //     	$orderData=$orderData[key($orderData)];
    //     	// arr['arrPaypal'->['campo','campo2'...] ] devuelve el arreglosolo de la derecha
    //     	$orderData['email']=$payer->payer_info->email;
    //         $order= Order::createFormPaypalResponse($orderData,$shopping_cart,\Session::get('id_pago'));
    //         return view('orders.order',['order'=>$order,'shopping_cart'=>$shopping_cart]);
    //     }
    // }

    // /**
    //  * Remove the specified resource from storage.
    //  *
    //  * @param  int  $id
    //  * @return \Illuminate\Http\Response
    //  */
    // public function destroy($id)
    // {
    //     //
    // }
}
