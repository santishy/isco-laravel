<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Mail\OrderCreated;
use Illuminate\Support\Facades\Mail;
class Order extends Model
{
    protected $table='orders';
    protected $primaryKey='id';
    protected $fillable=['line1','line2','recipient_name','code_postal',
    'state','country_code','city','shopping_cart_id','id_pago','email',
    'total','phone'];
    public static function createFormPaypalResponse($orderData,$shopping_cart)
    {
    	/*$payer=$response->payer;
    	$orderData=(array) $payer->payer_info->shipping_address;
    	$orderData=$orderData[key($orderData)];
    	// arr['arrPaypal'->['campo','campo2'...] ] devuelve el arreglosolo de la derecha
    	$orderData['email']=$payer->payer_info->email;*/
    	$orderData['shopping_cart_id']=$shopping_cart->id;
    	$orderData['id_pago']=\Session::get('id_pago');
    	$orderData['total']=$shopping_cart->total();
    	return Order::create($orderData);
    }
    public function address()
    {
        return $this->line1.' '.$this->line2;
    }
    public function scopeLatest($query)
    {
        return $query->orderID()->monthly();
    }
    public function scopeOrderID($query)
    {
        return $query->orderBy('id','desc');
    }
    public function scopeMonthly($query)
    {
        return $query->whereMonth('created_at','=',date('m'));
    }
    public static function totalMonth()
    {
        return Order::monthly()->sum('total');
    }
    public static function totalMonthCount()
    {
        return Order::monthly()->count();
    }
    public function sendEmail()
    {
        return Mail::to('santi_shy@hotmail.com')
            ->send(new OrderCreated($this));
    }
    public function shoppingCart()
    {
        return belongsTo('App\ShoppingCart');
    }
    public function customID(){
        return $this->shoppingCart->customid;
    }
}
