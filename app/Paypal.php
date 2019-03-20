<?php

namespace App;

use Config;
use URL;
// use PayPal\Core\PayPalHttpClient;
// use PayPal\v1\Payments\PaymentCreateRequest;
// use PayPal\v1\Payments\PaymentExecuteRequest;
// use PayPal\Core\SandboxEnvironment;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;
use PayPal\Rest\ApiContext;
use PayPal\Api\PaymentExecution;
use PayPal\Auth\OAuthTokenCredential;

class Paypal{
    public $client,$environment,$ApiContext,$total;
    public $PayerID,$paymentId;
    public function __construct(){
        date_default_timezone_set(@date_default_timezone_get());
        // Adding Error Reporting for understanding errors properly
        error_reporting(E_ALL);
        ini_set('display_errors', '1');

        $clientid=Config::get('services.paypal.clientid');
        $secret=Config::get('services.paypal.secret');
    
        $this->ApiContext = $this->getApiContext($clientid,$secret);

        // $this->environment= new SandboxEnvironment($clientid,$secret);
        // $this->client = new PayPalHttpClient($this->environment);
    }
    function getApiContext($clientId, $clientSecret)
    {
    // #### SDK configuration
    // Register the sdk_config.ini file in current directory
    // as the configuration source.
    /*
    if(!defined("PP_CONFIG_PATH")) {
        define("PP_CONFIG_PATH", __DIR__);
    }
    */
    // ### Api context
    // Use an ApiContext object to authenticate
    // API calls. The clientId and clientSecret for the
    // OAuthTokenCredential class can be retrieved from
    // developer.paypal.com
    $apiContext = new ApiContext(
        new OAuthTokenCredential(
            $clientId,
            $clientSecret
        )
    );
    // Comment this line out and uncomment the PP_CONFIG_PATH
    // 'define' block if you want to use static file
    // based configuration
    $apiContext->setConfig(
        array(
            'mode' => 'sandbox',
            'log.LogEnabled' => true,
            'log.FileName' => '../PayPal.log',
            'log.LogLevel' => 'DEBUG', // PLEASE USE `INFO` LEVEL FOR LOGGING IN LIVE ENVIRONMENTS
            'cache.enabled' => true,
            //'cache.FileName' => '/PaypalCache' // for determining paypal cache directory
            // 'http.CURLOPT_CONNECTTIMEOUT' => 30
            // 'http.headers.PayPal-Partner-Attribution-Id' => '123123123'
            //'log.AdapterFactory' => '\PayPal\Log\DefaultLogFactory' // Factory class implementing \PayPal\Log\PayPalLogFactory
        )
    );
    // Partner Attribution Id
    // Use this header if you are a PayPal partner. Specify a unique BN Code to receive revenue attribution.
    // To learn more or to request a BN Code, contact your Partner Manager or visit the PayPal Partner Portal
    // $apiContext->addRequestHeader('PayPal-Partner-Attribution-Id', '123123123');
    return $apiContext;
}
   public function getPayment(){
        $payment = Payment::get($this->paymentId,$this->ApiContext);
        return $payment;
   }
   public function getExecution(){
        $execution = new PaymentExecution();
        $execution->setPayerId($this->PayerID);
        return $execution;
   }
   public function setAttributes($request){
        $this->paymentId = $request->paymentId;
        $this->PayerID = $request->PayerID;
        return;
   }
   public function execute(){
        $payment = $this->getPayment();
        try{

            $result = $payment->execute($this->getExecution(),$this->ApiContext);
             
            try{             
                $payment = Payment::get($this->paymentId,$this->ApiContext);
            }catch(Exception $ex)
            {
                dd($ex);
                exit(1);
            }
        }catch(Exception $ex){
            dd($ex);
            exit(1);
        }
        
        return $payment; //OJO !!! AKI ESTA LA RESPUESTA DE PAYPAL PARA GUARDAR LO QUE SE DABA GUARDAAR
   }
    public function generate($shoppingCart){
        $this->shoppingCart = $shoppingCart;
        $payment = new Payment();
        $payment->setIntent('sale')
        ->setPayer($this->payer())
        ->setRedirectUrls($this->getUrls())
        ->setTransactions(array($this->getTransaction()));
        $request = clone $payment;
        
        try {
            $payment->create($this->ApiContext);
        } catch (Exception $ex) {
            dd($ex);
            exit(1);
        }
        return $payment;
    }
    public function createPayment($payment){
        try {
            $payment->create($this->ApiContext);
        } catch (Exception $ex) {
            dd($ex);
            exit(1);
        }
    }
    public function payer(){
        $payer=new Payer();
        $payer->setPaymentMethod("paypal");
        return $payer;
    }
    public function setItem($product){

        $item = new Item();
        $item->setName($product->descripcion)
        ->setCurrency('MXN')
        ->setQuantity($product->qty)
        ->setSku($product->sku)
        ->setPrice($product->precio);
        return $item;
    }
    public function getItemList($items){
        $itemList = new ItemList();
        $itemList->setItems($items);
        return $itemList;
    }
    public function getDetails(){
        $details = new Details();
        $details->setShipping(99)
        ->setTax(0)
        ->setSubtotal($this->shoppingCart->total());
        return $details;
    }
    public function getAmount(){
        $amount = new Amount();
        $amount->setCurrency('MXN')
        ->setTotal($this->shoppingCart->amount()+99)
        ->setDetails($this->getDetails());
        return $amount;
    } 

    public function getTransaction(){       
        $products = $this->shoppingCart->BelongsToManyArticulos();
        $items = array();
        foreach ($products->get() as $product) {
            array_push($items,$this->setItem($product));
        }
        $transaction = new Transaction();
        $transaction->setAmount($this->getAmount())
        ->setItemList($this->getItemList($items))
        ->setDescription("Compra en ISCO COMPUTADORAS")
        ->setInvoiceNumber(uniqid());
        return $transaction;
    }
    public function getUrls(){
        $redirectUrls = new RedirectUrls();
        $redirectUrls->setReturnUrl(URL::Route('execute'))
        ->setCancelUrl(url('/'));
        return $redirectUrls;
    }

    //solicitud de cobro
    // public function buildPaymentRequest($amount){
    // 	$request = new PaymentCreateRequest();
    // 	$body = [
    // 		"intent" => "sale",
    // 		"transactions" => [
    // 			[
    // 				"amount" => ["total" => $amount, "currency" => "MXN"]
    // 			]
    // 		],
    // 		"payer" => [
    // 			"payment_method" => "paypal"
    // 		],
    // 		"redirect_urls"=>[
    // 				"cancel_url"=>"/",
    // 				"return_url"=>"/"
    // 			]
    // 	];
    // 	$request->body = $body;
    // 	return $request;
    // }
    // public function charge($amount){
    //    return  $this->client->execute($this->buildPaymentRequest($amount));
    // }
}
// use Illuminate\Database\Eloquent\Model;
// use App\Articulo;
// use App\Dolar;
// class Paypal
// {
//     private $_apiContext;
//     private $shopping_car;
//     private $request;
//     private $_clientID='AVFlmFoXKSRgugi6J4UQa2Rmmry54Vfy_jEm6dE770XppCCb8u1dU641SsVd0u_-bynp-dO2C_WeEN6B';
//     private $_clientSecret='EB0gn3RBrBsEBRLcVQ6y4gGaQWSSeHHCxyM05kOk3tnp8oc_PR3V1XIhjKYwnyFfs1S-_SlB7mXWyXH9';
//     private $wayToPay;
//     public function __construct($request)
//     {
//         $this->request=$request;
//     	$this->_apiContext=\PaypalPayment::ApiContext($this->_clientID,$this->_clientSecret);
//     	$this->shopping_cart=$request->shopping_cart;
//     	$config=config('paypal_payment');
//     	$flatConfig=array_dot($config);
//     	$this->_apiContext->setConfig($flatConfig);
//         $this->wayToPay=$request->forma_pago;
//     }
//     public function generate()
//     {
//         $payment=\PaypalPayment::payment()->setIntent('sale')
//                                 ->setPayer($this->payer())
//                                 ->setTransactions([$this->transaction()])
//                                 ->setRedirectUrls($this->redirectUrls());

//         try{
//             $payment->create($this->_apiContext);
//             //$payment = \PaypalPayment::getById($payment->id,$this->_apiContext);

//         }catch (\Exception $ex) {
//             dd($ex);
//             return array('error'=>true);
//         }
//         return $payment;
//     }
//     public function address()
//     {
//         $addr= \PaypalPayment::address();
//         $addr->setLine1("3909 Witmer Road");
//         $addr->setLine2("Niagara Falls");
//         $addr->setCity("Niagara Falls");
//         $addr->setState("NY");
//         $addr->setPostalCode("14305");
//         $addr->setCountryCode("US");
//         $addr->setPhone("716-298-1822");
//         return $addr;
//     }
//     public function credit_card()
//     {
//         return \PaypalPayment::creditCard()
//                     /*->setType("visa")
//                     ->setNumber("4758411877817150")
//                     ->setExpireMonth("05")
//                     ->setExpireYear("2019")
//                     ->setCvv2("456")
//                     ->setFirstName("Joe")
//                     ->setLastName("Shopper");*/
//                 ->setType($this->request->type)
//                 ->setNumber($this->request->number)
//                 ->setExpireMonth($this->request->expire_month)
//                 ->setExpireYear($this->request->expire_year)
//                 ->setCvv2($this->request->cvv2)
//                 ->setFirstName($this->request->first_name)
//                 ->setLastName($this->request->last_name);
//     }
//     public function fi()
//     {
//         return \PaypalPayment::fundingInstrument()
//                     ->setCreditCard($this->credit_card());
//     }
//     public function payer()
//     {
//         $payer=\PaypalPayment::payer();
//         if($this->wayToPay=='credit_card')
//         {
//             $this->address();
//             return $payer->setPaymentMethod("credit_card")
//                     ->setFundingInstruments(array($this->fi()));
//         }
//         else
//             return $payer->setPaymentMethod('paypal');
//     }
//     public function redirectUrls()
//     {
//         return \PaypalPayment::redirectUrls()
//                 ->setReturnUrl(url('/pagos/updateAndStore'))
//                 ->setCancelUrl(url('/carrito'));
//     }
//     public function transaction()
//     {
//         return \PaypalPayment::transaction()
//                 ->setAmount($this->amount())
//                 ->setItemList($this->items())
//                 ->setDescription('Compra en Isco Computadoras')
//                 ->setInvoiceNumber(\Session::get('pago_id'));
//     }
//     public function items()
//     {

//         $items=[];
//         $articulos=$this->shopping_cart->BelongsToManyArticulos()->get();
//         foreach ($articulos as $articulo)
//         {
//             array_push($items, $articulo->paypalArticulo());
//         }

//         return \PaypalPayment::itemList()
//                 ->setItems($items);
//     }
//     public function amount()
//     {
//         return \PaypalPayment::amount()
//                 ->setCurrency('USD')
//                 ->setTotal($this->request->shopping_cart->total())
//                 ->setDetails($this->details());
//     }
//     public function details()
//     {
//         return \PaypalPayment::details()
//                 ->setTax(0)
//                 ->setShipping(0)
//                 ->setSubTotal($this->request->shopping_cart->total());
//     }
//     public function execute($paymentId,$payerID)
//     {
//         $payment = \PaypalPayment::getById($paymentId,$this->_apiContext);
//         $execution= \PaypalPayment::PaymentExecution()->setPayerId($payerID);
//         return $payment->execute($execution,$this->_apiContext);
//     }
// }
